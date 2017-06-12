<?php
/* @var $this \yii\web\View */
?>

<!-- nav-tabs -->
<ul class="site-sidebar-nav nav nav-tabs nav-tabs-line" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#sidebar-userlist" role="tab">
            <i class="icon wb-chat" aria-hidden="true"></i>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#sidebar-activity" role="tab">
            <i class="icon wb-user" aria-hidden="true"></i>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#sidebar-setting" role="tab">
            <i class="icon wb-settings" aria-hidden="true"></i>
        </a>
    </li>
</ul>

<div class="site-sidebar-tab-content tab-content">
    <div class="tab-pane fade active in" id="sidebar-userlist">
        <div>
            <div>
                <h5 class="clearfix">FRIEND LIST
                    <div class="pull-xs-right">
                        <a class="text-action" href="javascript:void(0)" role="button">
                            <i class="icon wb-plus" aria-hidden="true"></i>
                        </a>
                        <a class="text-action" href="javascript:void(0)" role="button">
                            <i class="icon wb-more-horizontal" aria-hidden="true"></i>
                        </a>
                    </div>
                </h5>
                <form class="margin-vertical-20" role="search">
                    <div class="input-search input-search-dark">
                        <i class="input-search-icon wb-search" aria-hidden="true"></i>
                        <input type="text" class="form-control" id="inputSearch" name="search" placeholder="Search Pages">
                        <button type="button" class="input-search-close icon wb-close" aria-label="Close"></button>
                    </div>
                </form>

                <div class="list-group">

                    <?php $this->render('list', ['dialogs' => [1,3,4,5]]) ?>

                </div>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="sidebar-activity">
        <div>
            <div>
                <h5>RECENT ACTIVITY</h5>
                <ul class="timeline timeline-icon timeline-single timeline-simple timeline-feed">
                    <li class="timeline-item">
                        <div class="timeline-dot bg-pink-600">
                            <i class="icon wb-heart" aria-hidden="true"></i>
                        </div>
                        <div class="timeline-content">
                            <small>
                                <time datetime="2015-07-08">6 minutes ago</time>
                            </small>
                            <p>Melissa liked your activity Drinks At My Place.</p>
                        </div>
                    </li>
                    <li class="timeline-item">
                        <div class="timeline-dot bg-green-600">
                            <i class="icon wb-check" aria-hidden="true"></i>
                        </div>
                        <div class="timeline-content">
                            <small>
                                <time datetime="2015-07-08">10 minutes ago</time>
                            </small>
                            <p>Tina is attending your activity Coffee @Starbucks</p>
                        </div>
                    </li>
                    <li class="timeline-item">
                        <div class="timeline-dot bg-green-600">
                            <i class="icon wb-chat" aria-hidden="true"></i>
                        </div>
                        <div class="timeline-content">
                            <small>
                                <time datetime="2015-07-08">15 minutes ago</time>
                            </small>
                            <p>Melissa liked your activity Drinks At My Place.</p>
                        </div>
                    </li>
                    <li class="timeline-item">
                        <div class="timeline-dot">
                            <i class="icon wb-plus" aria-hidden="true"></i>
                        </div>
                        <div class="timeline-content">
                            <small>
                                <time datetime="2015-07-08">20 minutes ago</time>
                            </small>
                            <p>Josh is now following you</p>
                        </div>
                    </li>
                </ul>

                <h5 class="margin-top-50">TASK STATISTICS</h5>
                <div class="contextual-progress">
                    <div class="clearfix">
                        <div class="progress-title">Features development</div>
                        <div class="progress-label">70%</div>
                    </div>
                    <div class="progress" data-goal="70">
                        <div class="progress-bar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="70"
                             style="width: 70%" role="progressbar">
                            <span class="progress-label"></span>
                        </div>
                    </div>
                </div>
                <div class="contextual-progress">
                    <div class="clearfix">
                        <div class="progress-title">Uploading files</div>
                        <div class="progress-label">30%</div>
                    </div>
                    <div class="progress" data-goal="60">
                        <div class="progress-bar progress-bar-success" aria-valuemin="0" aria-valuemax="100"
                             aria-valuenow="30" style="width: 30%" role="progressbar">
                            <span class="progress-label"></span>
                        </div>
                    </div>
                </div>
                <div class="contextual-progress">
                    <div class="clearfix">
                        <div class="progress-title">Traffc Margins</div>
                        <div class="progress-label">90%</div>
                    </div>
                    <div class="progress" data-goal="60">
                        <div class="progress-bar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="90"
                             style="width: 90%" role="progressbar">
                            <span class="progress-label"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="sidebar-setting">
        <div>
            <div>
                <h5>GENERAL SETTINGS</h5>
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="pull-xs-right margin-top-5">
                            <input type="checkbox" class="js-switch-small" data-plugin="switchery" data-size="small"
                                   checked />
                        </div>
                        <h5>Notifications</h5>
                        <p>Our very own image-less pure CSS and retina compatible check box.</p>
                    </li>
                    <li class="list-group-item">
                        <div class="pull-xs-right margin-top-5">
                            <input type="checkbox" class="js-switch-small" data-plugin="switchery" data-size="small"
                                   checked />
                        </div>
                        <h5>Show your emails</h5>
                        <p>Our very own image-less pure CSS and retina .</p>
                    </li>
                    <li class="list-group-item">
                        <div class="pull-xs-right margin-top-5">
                            <input type="checkbox" class="js-switch-small" data-plugin="switchery" data-size="small"
                                   checked />
                        </div>
                        <h5>Show recent activity</h5>
                        <p>Our very own image-less pure CSS and retina compatible check box.</p>
                    </li>
                    <li class="list-group-item">
                        <div class="pull-xs-right margin-top-5">
                            <input type="checkbox" class="js-switch-small" data-plugin="switchery" data-size="small"
                                   checked />
                        </div>
                        <h5>Show Task statistics</h5>
                        <p>Our very own image-less pure CSS and retina .</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="conversation" class="conversation">
    <div class="conversation-header">
        <a class="conversation-more pull-xs-right" href="javascript:void(0)">
            <i class="icon wb-more-horizontal" aria-hidden="true"></i>
        </a>
        <a class="conversation-return pull-xs-left" href="javascript:void(0)" data-toggle="close-chat">
            <i class="icon wb-chevron-left" aria-hidden="true"></i>
        </a>
        <div class="conversation-title">Mike</div>
    </div>
    <div class="chats">
        <div class="chat chat-left">
            <div class="chat-avatar">
                <a class="avatar" data-toggle="tooltip" href="#" data-placement="left" title="Edward Fletcher">
                    <img src="https://randomuser.me/api/portraits/men/5.jpg" alt="Edward Fletcher">
                </a>
            </div>
            <div class="chat-body">
                <div class="chat-content">
                    <p>
                        I'm just looking around.
                    </p>
                    <p>Will you tell me something about yourself? </p>
                    <time class="chat-time" datetime="2015-06-01T08:35">8:35 am</time>
                </div>
                <div class="chat-content">
                    <p>
                        Are you there? That time!
                    </p>
                    <time class="chat-time" datetime="2015-06-01T08:40">8:40 am</time>
                </div>
            </div>
        </div>
        <div class="chat">
            <div class="chat-avatar">
                <a class="avatar" data-toggle="tooltip" href="#" data-placement="right" title="June Lane">
                    <img src="https://randomuser.me/api/portraits/men/4.jpg" alt="June Lane">
                </a>
            </div>
            <div class="chat-body">
                <div class="chat-content">
                    <p>
                        Hello. What can I do for you?
                    </p>
                    <time class="chat-time" datetime="2015-06-01T08:30">8:30 am</time>
                </div>
            </div>
        </div>
    </div>
    <div class="conversation-reply">
        <div class="input-group">
      <span class="input-group-btn">
        <a href="javascript: void(0)" class="btn btn-pure btn-default icon wb-plus"></a>
      </span>
            <input class="form-control" type="text" placeholder="Say something">
            <span class="input-group-btn">
        <a href="javascript: void(0)" class="btn btn-pure btn-default icon wb-image"></a>
      </span>
        </div>
    </div>
</div>