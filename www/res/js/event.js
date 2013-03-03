/**
* Adds jQuery event dispatcher modal to any object.
*/
$(function() {
 var slice = Array.prototype.slice;

 $.addEventModel = function ( object ) {
   var $dispatcher = $('<div>');

   object.$_dispatcher = $dispatcher;

   object.on = function () {
     $dispatcher.on.apply($dispatcher, slice.apply(arguments));
   };

   object.off = function () {
     $dispatcher.off.apply($dispatcher, slice.apply(arguments));
   };

   object.trigger = function () {
     $dispatcher.trigger.apply($dispatcher, slice.apply(arguments));
   };
 };
});
 