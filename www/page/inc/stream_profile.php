<!-- edit profile -->
<div id="profileModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="profileModalLabel">Profile</h3>
  </div>

  <div class="modal-body">
		<div class="alert alert-error" style="display: none;" id="signup-alert"></div>

		<p>You can change your profile details here.</p>
		<form class="form-horizontal">
		  
		  <div class="control-group">
				<label class="control-label" for="nameInp">Name</label>
				<div class="controls">
				  <input type="text" id="nameInp" placeholder="... your identity" required>
				</div>
		  </div>
		  
		  <div class="control-group">
				<label class="control-label" for="titleInp">Title</label>
				<div class="controls">
				  <input type="text" id="titleInp" placeholder="... your job">
				</div>
		  </div>

		  <hr />

		  <div class="control-group">
				<label class="control-label" for="orgInp">Organisation</label>
				<div class="controls">
				  <input type="text" id="orgInp" placeholder="... your identity" required>
				</div>
		  </div>
		  
		</form>
  </div>

  <div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
		<button class="btn btn-primary" id="profile-save">Save</button>
  </div>
</div>

<!-- Le javascript
================================================== -->

<script>
	$(function(){

		var $modal = $('#profileModal');

		$modal.find('input').on('keydown', function(e){
			if (e.keyCode == 13){
				$('#profile-save').trigger('click');
			}
		});
		
		$modal.on('shown', function() {
			$("#nameInp").focus();
		});
		
		$('#profile-save').click(function(e){
			e.preventDefault();
			
			var name = $('#nameInp').val();
			var title = $('#titleInp').val();
			var org = $('#orgInp').val();
			
			if (name && org){
				// $modal.loaderlay({message: 'Saving ...'});
				api.setUser(apiUser.email, {
					name: name,
					org:  org
				}, function() {
					console.log('saved');
					$modal.modal('hide');
				});
			}
		});
	
	});
</script>