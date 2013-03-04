
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
            <img src="http://placekitten.com/35/35" />
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

        <ul class="wip-tags unstyled">
          <span class="tag">javascript</span>
        </ul>

        <div class="wip-text">
          <div class="wip-avatar">
            <img src="http://placekitten.com/35/35" />
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
          <div class="wip-comment">
            <div class="input-append">
              <input id="appendedInputButton" type="text" placeholder="Type comment..." />
              <button class="btn btn-small" type="button"><i class="icon-reply"></i> Comment!</button>
            </div>
          </div>
        </div>
        <div class="wip-time">2 hours ago</div>
      </li>

      <h3 class="wip-date-div">Yesterday</h3>

    </ul>
  </div>
  <div class="span4">

    <div class="sidebar">

      <div class="user-profile">
        <div class="wip-avatar">
          <img class="user-avatar" src="http://placekitten.com/75/75" />
        </div>
        <h5 class="user-name"></h5>
        <p class="user-title"></p>
		    <div class="btn btn-small"><a id="profile-edit-btn" href="#profileModal" data-toggle="modal"><i class="icon-edit"></i> Edit</a></div>
      </div>

      <h5>Following:</h5>
      <span class="label">backbone.js</span>
      <span class="label">coffeescript</span>
      <span class="label">donkies</span>

      <br /><br />

      <h5>Organization:</h5>

      <div class="input-append">
        <input id="appendedInputButton" type="text" placeholder="email address" />
        <button class="btn" type="button">Invite!</button>
		<div id="">http://simplewip.com/?join&org=abc&email=tarwin@gmail.com</div>
      </div>

      <ul class="team-list unstyled">
        <li class="clearfix">
          <div class="wip-avatar pull-left"><img src="http://placekitten.com/20/20" /></div>
          <a href="">Matt Benton</a>
        </li>
        <li class="clearfix">
          <div class="wip-avatar pull-left"><img src="http://placekitten.com/20/20" /></div>
          <a href="">Tarwin</a>
        </li>
        <li class="clearfix">
          <div class="wip-avatar pull-left"><img src="http://placekitten.com/20/20" /></div>
          <a href="">Bob</a>
        </li>
      </ul>

    </div>

  </div>
</div>

<script src="/res/js/page-stream.js"></script>
<? require_once('./page/inc/stream_profile.php'); ?>
