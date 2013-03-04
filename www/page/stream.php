
<!-- <div class="row-fluid">
  <div class="span12">
    <div class="person-avatar">
      <img src='http://placekitten.com/70/70' />
    </div>
  </div>
</div> -->

<div class="row-fluid">
  <div class="span8">

    <ul class="wip-list unstyled">

      <li id="create-post" class="wip post">
        <div class="wip-text clearfix">
          <div class="wip-avatar">
            <img class="user-avatar" src="" width="35" height="35" />
          </div>
          <textarea id="post-text" class="input-block-level" placeholder="What are you working on today?"></textarea>
          <div>

            <select id="post-tags" data-placeholder="Tags" class="chzn-select input-block-level" multiple>
            </select>

          </div>
          <div class="wip-buttons">
            <button class="btn btn-danger">Sure, I could use some help</button>
            <button class="btn btn-success">I think I'm all set</button>
          </div>
        </div>
      </li>

      <li id="post-template" class="wip" style="display: none">

        <div class="wip-ribbon"></div>

        <div class="wip-text">
          <div class="wip-avatar">
            <img src="" class="avatar" width="35" height="35" />
          </div>
          <span class="wip-name">Jeremy W. </span>
          <span class="wip-message">Trying to get our backend CRM to connect and load info about our eComm users.</span>
        </div>
        <div class="wip-meta">
<!--          <div class="wip-comment-list">
            <a href="#" class="wip-comment">&ndash; 3 comments &ndash;</a>
            <div class="wip-comment">
              <div class="wip-avatar">
                <img src="http://placekitten.com/25/25" />
              </div>
              <span class="wip-name">Andy J.</span> Ping me if you need api documentation it’s kind of a mess right now
            </div>
          </div>-->
          <ul class="wip-tags unstyled">
          </ul>

          <div class="wip-comment-list"></div>

          <div class="wip-comment">
            <div class="input-append">
              <input id="appendedInputButton" class="input-block-level wip-comment-input" type="text" placeholder="Type comment..." />
              <button class="btn btn-small" type="button"><i class="icon-reply"></i> Comment!</button>
            </div>
          </div>


        </div>
        <div class="wip-time"></div>
      </li>

      <h3 class="wip-date-div">Yesterday</h3>

      <li class="wip">

        <div class="wip-ribbon"></div>

        <div class="wip-text">
          <div class="wip-avatar">
            <img src="http://placekitten.com/35/35" />
          </div>
          <span class="wip-name">Jeremy W. </span>
          <span class="wip-message">Trying to get our backend CRM to connect and load info about our eComm users.</span>
        </div>
        <div class="wip-meta">
          <ul class="wip-tags unstyled">
          </ul>

          <div class="wip-comment-list">
            <div class="wip-comment">
              <div class="wip-avatar">
                <img src="http://placekitten.com/25/25" />
              </div>
              <span class="wip-name">Andy J.</span> Ping me if you need api documentation it’s kind of a mess right now
            </div>
          </div>

          <div class="wip-comment">
            <div class="input-append">
              <input id="appendedInputButton" class="input-block-level wip-comment-input" type="text" placeholder="Type comment..." />
              <button class="btn btn-small" type="button"><i class="icon-reply"></i> Comment!</button>
            </div>
          </div>


        </div>
        <div class="wip-time">1 day ago</div>
      </li>

    </ul>
  </div>
  <div class="span4">

    <div class="sidebar">

      <div class="user-profile">
        <div class="wip-avatar">
          <img class="user-avatar" src="" width="75" height="75" />
        </div>
        <h5 class="user-name"></h5>
        <p class="user-title"></p>
		    <div class="btn btn-small"><a id="profile-edit-btn" href="#profileModal" data-toggle="modal"><i class="icon-edit"></i> Edit</a></div>
      </div>

      <h5>Following:</h5>
      <span class="label">backbone.js</span>
      <span class="label">coffeescript</span>
      <span class="label">donkeys</span>

      <br /><br />

      <h5>Organization:</h5>

      <div class="input-append org-invite">
        <input class="appendedInputButton input-block-level" id="invite-email" type="email" placeholder="email address" required />
        <button class="btn" type="button" id="invite-btn">Invite!</button>
      </div>
	  <div id="invite-link-error" class="alert alert-warning" style="display: none;">Sorry, this user is already in the system.</div>
	  
	  <script>
		$(function(){
			$('#invite-email').on('keydown', function(e){
				if (e.keyCode == 13){
					$('#invite-btn').trigger('click');
				}
			});
			$('#invite-btn').click(function(e){
			
				$('#invite-link-error').hide();
				
				var $e = $('#invite-email');
				var email = $e.val();
				if (email){
					if (email == apiUser.email){
						$('#invite-link-error').show();
					}
					api.getUser(email, function(user){
						if (!user){
							$e.val('');							
							var $in = $('#invite-link');
							$in.html('http://simplewip.com/?join&org=' + apiUser.orgId + '&email=' + encodeURIComponent(email));
							$('#invite-link-email').html(email);
							$('#inviteModal').modal('show');
						}else{
							$('#invite-link-error').show();
						}
					});
				};
			});
		});
	  </script>

      <ul class="team-list unstyled">
        <li id="team-memember-template" class="clearfix">
          <div class="wip-avatar pull-left"><img src="" width="20" height="20" /></div>
          <a class="user-name" href="">Matt Benton</a>
        </li>
      </ul>

    </div>

  </div>
</div>

<script src="/res/js/page-stream.js"></script>
<? require_once('./page/inc/stream_profile.php'); ?>
<? require_once('./page/inc/stream_invite.php'); ?>
