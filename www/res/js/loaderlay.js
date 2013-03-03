if ( ! window.FPClass ) {
	// Author: Steffen Rusitschka
	// http://www.ruzee.com/blog/2008/12/javascript-inheritance-via-prototypes-and-closures
	(function(){
		var isFn = function(fn) { return typeof fn == "function"; };
		FPClass = function(){};
		FPClass.create = function(proto) {
			var k = function(magic) { // call init only if there's no magic cookie
				if (magic != isFn && isFn(this.init)) this.init.apply(this, arguments);
			};
			k.prototype = new this(isFn); // use our private method as magic cookie
			for (key in proto) (function(fn, sfn){ // create a closure
				k.prototype[key] = !isFn(fn) || !isFn(sfn) ? fn : // add _super method
				function() { this._super = sfn; return fn.apply(this, arguments); };
			})(proto[key], k.prototype[key]);
			k.prototype.constructor = k;
			k.extend = this.extend || this.create;
			return k;
		};
		// Wrap jQuery event binding.
		FPClass.prototype.on = function( events, selector, data, handler ) {
			if ( ! this.__$ ) this.__$ = $("<div></div>");
			this.__$.on.call(this.__$, events, selector, data, $.proxy(handler, this) );
		};
		FPClass.prototype.off = function( events, selector, handler ) {
			if ( ! this.__$ ) this.__$ = $("<div></div>");
			this.__$.off.call(this.__$, events, selector, handler );
		};
		// Wrap jQuery event invoking.
		FPClass.prototype.trigger = function( eventType, extraParameters ) {
			if ( ! this.__$ ) this.__$ = $("<div></div>");
			this.__$.trigger.call(this.__$, eventType, extraParameters );
		};
	})();
};

var Loaderlay = FPClass.create({
	init : function( params ) {
		Loaderlay.instances.push(this);
		this.show(params);
	},
	
	destroy : function() {
		// Remove reference to this instance from static Loaderlay
		for (i in Loaderlay.instances) {
			if (Loaderlay.instances[i] == this) {
				Loaderlay.instances.splice(i, 1);
				break;
			}
		}
		
		// Free references for GC
		this.$target 	= null;
		this.$body		= null;
		this.$window	= null;
		this.$el		= null;
		this.$backdrop	= null;
		this.$message	= null;
		this.$icon		= null;
	},
	
	show : function( params ) {
		var options = {
			message : null,
			target	: null,
			color	: "#000",
			opacity	: 0.7,
			context	: null,
			icon	: true,
			fadeIn	: false
		};
		
		$.extend(options, params);
		
		this.color 		= options.color;
		this.opacity 	= options.opacity;
		this.isBody		= false;
		
		if (options.context) {
			var doc 		= options.context.ownerDocument;
			var win 		= doc.parentWindow || doc.defaultView;
			this.$body		= $(doc.body);
			this.$window	= $(win);
		} else {
			this.$body		= $(document.body);
			this.$window	= $(window);
		}
		
		// Determine if our target is the entire page (body) or an individual DOM element.
		if (options.target) {
			this.$target = (typeof options.target == "string") ? $(options.target, this.$body) : options.target;
			if (this.$target.get(0).nodeName.toUpperCase() == "BODY") this.isBody = true;
		} else {
			this.$target	= $("body", this.$body);
			this.isBody 	= true;
		}

		if ( ! this.$el) {
			var style		= options.fadeIn ? 'style="display:none;"' : '';
			this.$el		= $('<div ' + style + ' class="loaderlay"></div>').appendTo(this.$body);
			this.$backdrop	= $('<div class="loaderlay-backdrop"></div>').appendTo(this.$el);
			this.$message	= $('<div class="loaderlay-message"></div>').appendTo(this.$el);
			this.$icon 		= $('<div class="loaderlay-icon"></div>').appendTo(this.$el);
		}
		
		if (options.icon) {
			this.$icon.show();
		} else {
			this.$icon.hide();
		}
		
		if (options.message) {
			this.$el.addClass("s-message");
			this.$message.html(options.message).show();
		} else {
			this.$el.removeClass("s-message");
			this.$message.hide();
		}
		
		if (this.isBody) {
			this.$el.addClass("s-full");
		} else {
			this.$el.removeClass("s-full");
		}
		
		this.resize();
		
		if (options.fadeIn) this.$el.fadeIn();
	},
	
	hide : function( fadeOut ) {
		if (this.$el) {
			if (fadeOut) {
				this.$el.fadeOut();
			} else {
				this.$el.hide();
			}
		}
	},
	
	resize : function() {
		if (this.$el) {
			if (this.$el.hasClass("s-full")) {
				this.$el.css({
					width		: this.$window.width(),
					height		: this.$window.height(),
					top			: 0,
					left		: 0
				});
			} else {
				var offset = this.$target.offset();
				this.$el.css({
					width		: this.$target.outerWidth(),
					height		: this.$target.outerHeight(),
					top			: offset.top,
					left		: offset.left
				});
			}
			
			this.$backdrop.css({
				background	: this.color,
				opacity		: this.opacity
			});
		}
	},
	
	message : function( message ) {
		this.$el.addClass("s-message");
		this.$message.text(message);
		this.resize();
	}
	// End of Loaderlay
});

Loaderlay.instances = [];

Loaderlay.hideAll = function( fadeOut ) {
	var len = Loaderlay.instances.length;
	for (var i=0; i<len; i++) {
		Loaderlay.instances[i].hide(fadeOut);
	}
};

$.fn.loaderlay = function( options ) {
	var params = arguments;
	return this.each(function() {
		var $this = $(this);
		
		if (options == undefined) {
			options = {};
		} else if (typeof options == "string") {
			var instance = $this.data("loaderlay");
			if (params.length > 1) {
				var args = [];
				for (var i=1; i<params.length; i++) args.push(params[i]);
				return instance[options].apply(instance, args);
			} else {
				return instance[options]();
			}
		}
		
		options.target	= $this;
		options.context = $this.context;
		
		// Destroy previously attached instance if there is one.
		var instance = $this.data("loaderlay");
		if (instance) {
			instance.destroy();
		}
		
		$this.data("loaderlay", new Loaderlay(options));
	});
};

$.fn.loaderlay.hideAll = function( fadeOut ) {
	Loaderlay.hideAll(fadeOut);
};