
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
              <option value=""></option> 
              <option value="php">php</option> 
              <option value="javascript">javascript</option> 
              <option value="backbone">backbone</option> 
              <option value="jquery">jquery</option> 
            </select>

          </div>
          <div class="wip-buttons">
            <button class="btn btn-success">I think I'm all set</button>
            <button class="btn btn-info">Sure, I could use some help</button>
          </div>
        </div>
      </li>

      <li id="post-template" class="wip" style="display: none">
        <div class="wip-text">
          <div class="wip-avatar">
            <img src="http://placekitten.com/35/35" />
          </div>
          <span class="wip-name">Jeremy W. </span>
          <div class="wip-message">Trying to get our backend CRM to connect and load info about our eComm users.</div>
        </div>
        <div class="wip-meta">
          <ul class="wip-tags unstyled">
            <span class="label label-info">javascript<span class="wip-follow-tooltip">&#10003;</span></span>
            <span class="label label-info">php<span class="wip-follow-tooltip">&#10003;</span></span>
            <span class="label label-info">backbone.js<span class="wip-follow-tooltip">&#10003;</span></span>
          </ul>
            <button class="btn btn-mini" type="button">I can help</button>
          <!-- <div class="wip-comment">
            <div class="wip-avatar">
              <img src="http://placekitten.com/25/25" />
            </div>
            <span class="wip-name">Andy J.</span> Ping me if you need api documentation it’s kind of a mess right now
          </div> -->
        </div>
        <div class="wip-time">2 hours ago</div>
      </li>

    </ul>
  </div>
  <div class="span4">

    <div class="sidebar">

      <div class="user-profile">
        <div class="wip-avatar">
          <img src="http://placekitten.com/75/75" />
        </div>
        <h5>Jack Johnson</h5>
        <p>iPhone developer</p>
		<div class="btn btn-small"><a id="profile-edit-btn" href="#profileModal" data-toggle="modal"><i class="icon-edit"></i> Edit</a></div>
      </div>

    </div>

  </div>
</div>

<script src="/res/js/page-stream.js"></script>
<? require_once('./page/inc/stream_profile.php'); ?>