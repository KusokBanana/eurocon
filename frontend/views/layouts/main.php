<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\models\Person;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
$user = Person::getPerson(Yii::$app->user);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap admin template">
    <meta name="author" content="">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="apple-touch-icon" href="../../web/img/layer_images/apple-touch-icon.png">
    <link rel="shortcut icon" href="../../web/favicon.ico">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
    <!--[if lt IE 9]>
    <script src="../../web/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->
    <!--[if lt IE 10]>
    <script src="../../web/vendor/media-match/media.match.min.js"></script>
    <script src="../../web/vendor/respond/respond.min.js"></script>
    <![endif]-->
    <?php $this->registerJs('Breakpoints();');; ?>
    <?php $this->registerJs('(function(document, window, $) {
            \'use strict\';
            var Site = window.Site;
            $(document).ready(function() {
                Site.run();
            });
        })(document, window, jQuery);') ?>
    <?php $this->head() ?>
</head>
<body class="animsition site-navbar-small dashboard">
<?php $this->beginBody() ?>

<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega navbar-inverse"
     role="navigation">

    <div class="navbar-header">
        <button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided"
                data-toggle="menubar">
            <span class="sr-only">Toggle navigation</span>
            <span class="hamburger-bar"></span>
        </button>
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse"
                data-toggle="collapse">
            <i class="icon wb-more-horizontal" aria-hidden="true"></i>
        </button>
        <?= Html::a(Html::img('@web/img/layer_images/logo.png', [
                'class' => 'navbar-brand-logo navbar-brand-logo-normal',
                'title' => 'Remark'
        ]), ['/'], ['class' => 'navbar-brand navbar-brand-center']); ?>
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-search"
                data-toggle="collapse">
            <span class="sr-only">Toggle Search</span>
            <i class="icon wb-search" aria-hidden="true"></i>
        </button>
    </div>
    <div class="navbar-container container-fluid">
        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
            <!-- Navbar Toolbar -->
            <ul class="nav navbar-toolbar">
                <li class="nav-item hidden-float" id="toggleMenubar">
                    <a class="nav-link" data-toggle="menubar" href="#" role="button">
                        <i class="icon hamburger hamburger-arrow-left">
                            <span class="sr-only">Toggle menubar</span>
                            <span class="hamburger-bar"></span>
                        </i>
                    </a>
                </li>

                <li class="nav-item hidden-float">
                    <a class="nav-link icon wb-search" data-toggle="collapse" href="#" data-target="#site-navbar-search"
                       role="button">
                        <span class="sr-only">Toggle Search</span>
                    </a>
                </li>
            </ul>
            <!-- End Navbar Toolbar -->
            <!-- Navbar Toolbar Right -->
            <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" data-animation="scale-up"
                       aria-expanded="false" role="button">
                        <span class="flag-icon flag-icon-us"></span>
                    </a>
                    <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                            <span class="flag-icon flag-icon-gb"></span> English</a>
                        <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                            <span class="flag-icon flag-icon-fr"></span> French</a>
                        <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                            <span class="flag-icon flag-icon-cn"></span> Chinese</a>
                        <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                            <span class="flag-icon flag-icon-de"></span> German</a>
                        <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                            <span class="flag-icon flag-icon-nl"></span> Dutch</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false"
                       data-animation="scale-up" role="button">
              <span class="avatar avatar-online">
                  <?= Html::img($user->image, [
                      'alt' => '...'
                  ]) ?>
                <i></i>
              </span>
                    </a>
                    <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon fa-question" aria-hidden="true"></i> FAQ</a>
                        <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon wb-settings" aria-hidden="true"></i> Settings</a>
                        <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon wb-bookmark" aria-hidden="true"></i>About Eurocon</a>
                        <div class="dropdown-divider" role="presentation"></div>
                        <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon fa-sitemap" aria-hidden="true"></i> SITE MAP</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" title="Notifications"
                       aria-expanded="false" data-animation="scale-up" role="button">
                        <i class="icon wb-bell" aria-hidden="true"></i>
                        <span class="tag tag-pill tag-danger up">5</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-media" role="menu">
                        <div class="dropdown-menu-header">
                            <h5>NOTIFICATIONS</h5>
                            <span class="tag tag-round tag-danger">New 5</span>
                        </div>
                        <div class="list-group">
                            <div data-role="container">
                                <div data-role="content">
                                    <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                                        <div class="media">
                                            <div class="media-left p-r-10">
                                                <i class="icon wb-order bg-red-600 white icon-circle" aria-hidden="true"></i>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading">A new order has been placed</h6>
                                                <time class="media-meta" datetime="2017-06-12T20:50:48+08:00">5 hours ago</time>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                                        <div class="media">
                                            <div class="media-left p-r-10">
                                                <i class="icon wb-user bg-green-600 white icon-circle" aria-hidden="true"></i>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading">Completed the task</h6>
                                                <time class="media-meta" datetime="2017-06-11T18:29:20+08:00">2 days ago</time>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                                        <div class="media">
                                            <div class="media-left p-r-10">
                                                <i class="icon wb-settings bg-red-600 white icon-circle" aria-hidden="true"></i>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading">Settings updated</h6>
                                                <time class="media-meta" datetime="2017-06-11T14:05:00+08:00">2 days ago</time>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                                        <div class="media">
                                            <div class="media-left p-r-10">
                                                <i class="icon wb-calendar bg-blue-600 white icon-circle" aria-hidden="true"></i>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading">Event started</h6>
                                                <time class="media-meta" datetime="2017-06-10T13:50:18+08:00">3 days ago</time>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                                        <div class="media">
                                            <div class="media-left p-r-10">
                                                <i class="icon wb-chat bg-orange-600 white icon-circle" aria-hidden="true"></i>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading">Message received</h6>
                                                <time class="media-meta" datetime="2017-06-10T12:34:48+08:00">3 days ago</time>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-menu-footer">
                            <a class="dropdown-menu-footer-btn" href="javascript:void(0)" role="button">
                                <i class="icon md-settings" aria-hidden="true"></i>
                            </a>
                            <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                                All notifications
                            </a>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown">

                    <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" title="Messages"
                       aria-expanded="false" data-animation="scale-up" role="button">
                        <i class="icon wb-envelope" aria-hidden="true"></i>
                        <span class="tag tag-pill tag-info up">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-media" role="menu">
                        <div class="dropdown-menu-header" role="presentation">
                            <h5>MESSAGES</h5>
                            <span class="tag tag-round tag-info">New 3</span>
                        </div>
                        <div class="list-group" role="presentation">
                            <div data-role="container">
                                <div data-role="content">
                                    <a class="list-group-item" href="javascript:void(0)" role="menuitem">
                                        <div class="media">
                                            <div class="media-left p-r-10">
                                              <span class="avatar avatar-sm avatar-online">
                                                  <?= Html::img('@web/img/portraits/2.jpg', [
                                                      'alt' => '...'
                                                  ]) ?>
                                                <i></i>
                                              </span>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading">Mary Adams</h6>
                                                <div class="media-meta">
                                                    <time datetime="2017-06-17T20:22:05+08:00">30 minutes ago</time>
                                                </div>
                                                <div class="media-detail">Anyways, i would like just do it</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="list-group-item" href="javascript:void(0)" role="menuitem">
                                        <div class="media">
                                            <div class="media-left p-r-10">
                                              <span class="avatar avatar-sm avatar-off">
                                                  <?= Html::img('@web/img/portraits/3.jpg', [
                                                      'alt' => '...'
                                                  ]) ?>
                                                <i></i>
                                              </span>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading">Caleb Richards</h6>
                                                <div class="media-meta">
                                                    <time datetime="2017-06-17T12:30:30+08:00">12 hours ago</time>
                                                </div>
                                                <div class="media-detail">I checheck the document. But there seems</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="list-group-item" href="javascript:void(0)" role="menuitem">
                                        <div class="media">
                                            <div class="media-left p-r-10">
                                              <span class="avatar avatar-sm avatar-busy">
                                                  <?= Html::img('@web/img/portraits/4.jpg', [
                                                      'alt' => '...'
                                                  ]) ?>
                                                <i></i>
                                              </span>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading">June Lane</h6>
                                                <div class="media-meta">
                                                    <time datetime="2017-06-16T18:38:40+08:00">2 days ago</time>
                                                </div>
                                                <div class="media-detail">Lorem ipsum Id consectetur et minim</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="list-group-item" href="javascript:void(0)" role="menuitem">
                                        <div class="media">
                                            <div class="media-left p-r-10">
                                              <span class="avatar avatar-sm avatar-away">
                                                  <?= Html::img('@web/img/portraits/5.jpg', [
                                                      'alt' => '...'
                                                  ]) ?>
                                                <i></i>
                                              </span>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading">Edward Fletcher</h6>
                                                <div class="media-meta">
                                                    <time datetime="2017-06-15T20:34:48+08:00">3 days ago</time>
                                                </div>
                                                <div class="media-detail">Dolor et irure cupidatat commodo nostrud nostrud.</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-menu-footer" role="presentation">
                            <a class="dropdown-menu-footer-btn" href="javascript:void(0)" role="button">
                                <i class="icon wb-settings" aria-hidden="true"></i>
                            </a>
                            <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                                See all messages
                            </a>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <?= Html::a(FA::icon('sign-out', ['class' => 'icon', 'aria-hidden' => 'true']),
                        ['/site/logout'], [
                            'class' => 'nav-link', 'role' => 'button']) ?>
                </li>

            </ul>
            <!-- End Navbar Toolbar Right -->
        </div>
        <!-- End Navbar Collapse -->
        <!-- Site Navbar Seach -->
        <div class="collapse navbar-search-overlap" id="site-navbar-search">
            <form role="search">
                <div class="form-group">
                    <div class="input-search">
                        <i class="input-search-icon wb-search" aria-hidden="true"></i>
                        <input type="text" class="form-control" name="site-search" placeholder="Search...">
                        <button type="button" class="input-search-close icon wb-close" data-target="#site-navbar-search"
                                data-toggle="collapse" aria-label="Close"></button>
                    </div>
                </div>
            </form>
        </div>
        <!-- End Site Navbar Seach -->
    </div>
</nav>

<div class="site-menubar site-menubar-light">
    <div class="site-menubar-body">
        <div>
            <div>
                <ul class="site-menu" data-plugin="menu">

                    <li class="dropdown site-menu-item has-sub">
                        <?= Html::a('<i class="icon wb-user" aria-hidden="true"></i>
                            <span class="site-menu-title">Me</span>', ['/'],
                            ['data-toggle' => 'dropdown', 'data-dropdown-toggle' => 'false']) ?>
                    </li>

                    <li class="dropdown site-menu-item has-sub">
                        <a data-toggle="dropdown" href="javascript:void(0)" data-dropdown-toggle="false">
                            <i class="icon wb-hammer" aria-hidden="true"></i>
                            <span class="site-menu-title">Projects</span>
                        </a>
                    </li>

                    <li class="ropdown site-menu-item has-sub">
                        <a data-toggle="dropdown" href="javascript:void(0)" data-dropdown-toggle="false">
                            <i class="icon wb-users" aria-hidden="true"></i>
                            <span class="site-menu-title">Friends</span>
                        </a>
                    </li>

                    <li class="ropdown site-menu-item has-sub">
                        <a data-toggle="dropdown" href="javascript:void(0)" data-dropdown-toggle="false">
                            <i class="icon wb-zoom-in" aria-hidden="true"></i>
                            <span class="site-menu-title">Analysis</span>
                        </a>
                    </li>

                    <li class="ropdown site-menu-item has-section has-sub">
                        <a data-toggle="dropdown" href="javascript:void(0)" data-dropdown-toggle="false">
                            <i class="icon wb-map" aria-hidden="true"></i>
                            <span class="site-menu-title">Locations</span>
                        </a>
                    </li>

                    <li class="ropdown site-menu-item has-section has-sub">
                        <a data-toggle="dropdown" href="javascript:void(0)" data-dropdown-toggle="false">
                            <i class="icon fa-group" aria-hidden="true"></i>
                            <span class="site-menu-title">Communities</span>
                        </a>
                    </li>

                    <li class="ropdown site-menu-item has-sub">
                        <a data-toggle="dropdown" href="javascript:void(0)" data-dropdown-toggle="false">
                            <i class="icon fa-newspaper-o" aria-hidden="true"></i>
                            <span class="site-menu-title">Projects news</span>
                        </a>
                    </li>

                    <li class="ropdown site-menu-item has-sub">
                        <a data-toggle="dropdown" href="javascript:void(0)" data-dropdown-toggle="false">
                            <i class="icon wb-shopping-cart" aria-hidden="true"></i>
                            <span class="site-menu-title">Marketplace</span>
                        </a>
                    </li>


                </ul>
            </div>
        </div>
    </div>
</div>

<?= $content ?>

<footer class="site-footer">
    <div class="site-footer-legal">© 2017
        <?= Html::img('@web/img/layer_images/logo.black.png', [
            'width' => '7%',
            'height' => '7%',
        ]) ?>
    </div>
    <div class="site-footer-right">

    </div>
</footer>

<!--<div class="wrap">-->
<!--    --><?php
//    NavBar::begin([
//        'brandLabel' => 'My Company',
//        'brandUrl' => Yii::$app->homeUrl,
//        'options' => [
//            'class' => 'navbar-inverse navbar-fixed-top',
//        ],
//    ]);
//    $menuItems = [
//        ['label' => 'Home', 'url' => ['/site/index']],
//        ['label' => 'About', 'url' => ['/site/about']],
//        ['label' => 'Contact', 'url' => ['/site/contact']],
//    ];
//    if (Yii::$app->user->isGuest) {
//        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
//        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
//    } else {
//        $menuItems[] = '<li>'
//            . Html::beginForm(['/site/logout'], 'post')
//            . Html::submitButton(
//                'Logout (' . Yii::$app->user->identity->username . ')',
//                ['class' => 'btn btn-link logout']
//            )
//            . Html::endForm()
//            . '</li>';
//    }
//    echo Nav::widget([
//        'options' => ['class' => 'navbar-nav navbar-right'],
//        'items' => $menuItems,
//    ]);
//    NavBar::end();
//    ?>
<!---->
<!--    <div class="container">-->
<!--        --><?//= Breadcrumbs::widget([
//            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
//        ]) ?>
<!--        --><?//= Alert::widget() ?>
<!--    </div>-->
<!--</div>-->

<!--<script src="../../web/vendor/babel-external-helpers/babel-external-helpers.js"></script>-->
<!--<script src="../../web/vendor/jquery/jquery.min.js"></script>-->
<!--<script src="../../web/vendor/tether/tether.min.js"></script>-->
<!--<script src="../../web/vendor/bootstrap/bootstrap.min.js"></script>-->
<!--<script src="../../web/vendor/animsition/animsition.min.js"></script>-->
<!--<script src="../../web/vendor/mousewheel/jquery.mousewheel.min.js"></script>-->
<!--<script src="../../web/vendor/asscrollbar/jquery-asScrollbar.min.js"></script>-->
<!--<script src="../../web/vendor/asscrollable/jquery-asScrollable.min.js"></script>-->
<!--<script src="../../web/vendor/switchery/switchery.min.js"></script>-->
<!--<script src="../../web/vendor/intro-js/intro.min.js"></script>-->
<!--<script src="../../web/vendor/screenfull/screenfull.min.js"></script>-->
<!--<script src="../../web/vendor/slidepanel/jquery-slidePanel.min.js"></script>-->
<!--<script src="../../web/vendor/chartist/chartist.min.js"></script>-->
<!--<script src="../../web/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.min.js"></script>-->
<!--<script src="../../web/vendor/aspieprogress/jquery-asPieProgress.min.js"></script>-->
<!--<script src="../../web/vendor/matchheight/jquery.matchHeight-min.js"></script>-->
<!--<script src="../../web/vendor/jquery-selective/jquery-selective.min.js"></script>-->
<!--<script src="../../web/vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>-->
<!--<script src="../../web/js/State.min.js"></script>-->
<!--<script src="../../web/js/Component.min.js"></script>-->
<!--<script src="../../web/js/Plugin.min.js"></script>-->
<!--<script src="../../web/js/Base.min.js"></script>-->
<!--<script src="../../web/js/Config.min.js"></script>-->
<!--<script src="../../web/js/assets/Menubar.min.js"></script>-->
<!--<script src="../../web/js/assets/Sidebar.min.js"></script>-->
<!--<script src="../../web/js/assets/PageAside.min.js"></script>-->
<!--<script src="../../web/js/assets/menu.min.js"></script>-->
<!--<script src="../../web/js/config/colors.min.js"></script>-->
<!--<script src="../../web/js/config/tour.min.js"></script>-->
<!--<script>-->
<!--    Config.set('assets', '../../web/js/assets');-->
<!--</script>-->
<!--<script src="../../web/js/assets/Site.min.js"></script>-->
<!--<script src="../../web/js/Plugin/asscrollable.min.js"></script>-->
<!--<script src="../../web/js/Plugin/slidepanel.min.js"></script>-->
<!--<script src="../../web/js/Plugin/switchery.min.js"></script>-->
<!--<script src="../../web/js/Plugin/matchheight.min.js"></script>-->
<!--<script src="../../web/js/Plugin/aspieprogress.min.js"></script>-->
<!--<script src="../../web/js/Plugin/bootstrap-datepicker.min.js"></script>-->
<?php //$this->registerJsFile('../../web/vendor/babel-external-helpers/babel-external-helpers.js', ['position' => yii\web\View::POS_LOAD]); ?>
<?php //$this->registerJsFile('../../web/vendor/jquery/jquery.min.js', ['position' => yii\web\View::POS_LOAD]); ?>
<?php //$this->registerJsFile('../../web/vendor/tether/tether.min.js', ['position' => yii\web\View::POS_LOAD]); ?>
<?php //$this->registerJsFile('../../web/vendor/bootstrap/bootstrap.min.js', ['position' => yii\web\View::POS_LOAD]); ?>
<?php //$this->registerJsFile('../../web/vendor/animsition/animsition.min.js', ['position' => yii\web\View::POS_LOAD]); ?>
<?php //$this->registerJsFile('../../web/vendor/mousewheel/jquery.mousewheel.min.js', ['position' => yii\web\View::POS_LOAD]); ?>
<?php //$this->registerJsFile('../../web/vendor/asscrollbar/jquery-asScrollbar.min.js', ['position' => yii\web\View::POS_LOAD]); ?>
<?php //$this->registerJsFile('../../web/vendor/asscrollable/jquery-asScrollable.min.js', ['position' => yii\web\View::POS_LOAD]); ?>
<?php //$this->registerJsFile('../../web/vendor/switchery/switchery.min.js', ['position' => yii\web\View::POS_LOAD]); ?>
<?php //$this->registerJsFile('../../web/vendor/intro-js/intro.min.js', ['position' => yii\web\View::POS_LOAD]); ?>
<?php //$this->registerJsFile('../../web/vendor/screenfull/screenfull.min.js', ['position' => yii\web\View::POS_LOAD]); ?>
<?php //$this->registerJsFile('../../web/vendor/slidepanel/jquery-slidePanel.min.js', ['position' => yii\web\View::POS_LOAD]); ?>
<?php //$this->registerJsFile('../../web/vendor/chartist/chartist.min.js', ['position' => yii\web\View::POS_LOAD]); ?>
<?php //$this->registerJsFile('../../web/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.min.js', ['position' => yii\web\View::POS_LOAD]); ?>
<?php //$this->registerJsFile('../../web/vendor/aspieprogress/jquery-asPieProgress.min.js', ['position' => yii\web\View::POS_LOAD]); ?>
<?php //$this->registerJsFile('../../web/vendor/matchheight/jquery.matchHeight-min.js', ['position' => yii\web\View::POS_LOAD]); ?>
<?php //$this->registerJsFile('../../web/vendor/jquery-selective/jquery-selective.min.js', ['position' => yii\web\View::POS_LOAD]); ?>
<?php //$this->registerJsFile('../../web/vendor/bootstrap-datepicker/bootstrap-datepicker.min.js', ['position' => yii\web\View::POS_LOAD]); ?>
<?php //$this->registerJsFile('../../web/js/State.min.js', ['position' => yii\web\View::POS_LOAD]); ?>
<?php //$this->registerJsFile('../../web/js/Component.min.js', ['position' => yii\web\View::POS_LOAD]); ?>
<?php //$this->registerJsFile('../../web/js/Plugin.min.js', ['position' => yii\web\View::POS_LOAD]); ?>
<?php //$this->registerJsFile('../../web/js/Base.min.js', ['position' => yii\web\View::POS_LOAD]); ?>
<?php //$this->registerJsFile('../../web/js/Config.min.js', ['position' => yii\web\View::POS_LOAD]); ?>
<?php //$this->registerJsFile('../../web/js/assets/Menubar.min.js', ['position' => yii\web\View::POS_LOAD]); ?>
<?php //$this->registerJsFile('../../web/js/assets/Sidebar.min.js', ['position' => yii\web\View::POS_LOAD]); ?>
<?php //$this->registerJsFile('../../web/js/assets/PageAside.min.js', ['position' => yii\web\View::POS_LOAD]); ?>
<?php //$this->registerJsFile('../../web/js/assets/menu.min.js', ['position' => yii\web\View::POS_LOAD]); ?>
<?php //$this->registerJsFile('../../web/js/config/colors.min.js', ['position' => yii\web\View::POS_LOAD]); ?>
<?php //$this->registerJsFile('../../web/js/config/tour.min.js', ['position' => yii\web\View::POS_LOAD]); ?>
<?php //$this->registerJs('Config.set(\'assets\', \'../../web/js/assets\');', yii\web\View::POS_LOAD); ?>
<?php //$this->registerJsFile('../../web/js/assets/Site.min.js', ['position' => yii\web\View::POS_LOAD]); ?>
<?php //$this->registerJsFile('../../web/js/Plugin/asscrollable.min.js', ['position' => yii\web\View::POS_LOAD]); ?>
<?php //$this->registerJsFile('../../web/js/Plugin/slidepanel.min.js', ['position' => yii\web\View::POS_LOAD]); ?>
<?php //$this->registerJsFile('../../web/js/Plugin/switchery.min.js', ['position' => yii\web\View::POS_LOAD]); ?>
<?php //$this->registerJsFile('../../web/js/Plugin/matchheight.min.js', ['position' => yii\web\View::POS_LOAD]); ?>
<?php //$this->registerJsFile('../../web/js/Plugin/aspieprogress.min.js', ['position' => yii\web\View::POS_LOAD]); ?>
<?php //$this->registerJsFile('../../web/js/Plugin/bootstrap-datepicker.min.js', ['position' => yii\web\View::POS_LOAD]); ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
