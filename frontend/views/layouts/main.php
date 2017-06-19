<?php

/* @var $this \yii\web\View */
/* @var $content string */
/* @var $user Person */

use frontend\models\Person;
use frontend\widgets\Chat;
use rmrevin\yii\fontawesome\FA;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
$user = Person::get();
$this->registerJsFile('@web/js/ajaxReload.js', ['depends' => [AppAsset::className()]])
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
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

    <!--[if lt IE 9]>
    <script src="../../web/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->
    <!--[if lt IE 10]>
    <script src="../../web/vendor/media-match/media.match.min.js"></script>
    <script src="../../web/vendor/respond/respond.min.js"></script>
    <![endif]-->

    <?php $this->registerLinkTag([
        'rel' => 'shortcut icon',
        'type' => 'image/x-icon',
        'href' => Url::to('@web/favicon.ico'),
    ]);?>

<!--    --><?php //$this->registerJs('Breakpoints();', yii\web\View::POS_READY);; ?>
    <?php $this->registerJs('(function(document, window, $) {
            \'use strict\';
            var Site = window.Site;
            $(document).ready(function() {
                Site.run();
            });
        })(document, window, jQuery);') ?>
    <?php $this->head() ?>
<!--    <script src="//js.pusher.com/3.1/pusher.min.js"></script>-->
</head>
<body class="animsition site-navbar-small <?= isset($this->params['body-class']) ? $this->params['body-class'] : 'dashboard' ?>">
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
<!--        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-search"-->
<!--                data-toggle="collapse">-->
<!--            <span class="sr-only">Toggle Search</span>-->
<!--            <i class="icon wb-search" aria-hidden="true"></i>-->
<!--        </button>-->
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

<!--                <li class="nav-item hidden-float">-->
<!--                    <a class="nav-link icon wb-search" data-toggle="collapse" href="#" data-target="#site-navbar-search"-->
<!--                       role="button">-->
<!--                        <span class="sr-only">Toggle Search</span>-->
<!--                    </a>-->
<!--                </li>-->
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
                <?php if (Person::$quest_id !== $user->id): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false"
                           data-animation="scale-up" role="button">
                          <span class="avatar avatar-online">
                              <?= Html::img($user->imageShow, [
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
                        <?= Chat::widget(['isFull' => true, 'isAjax' => false]) ?>
                    </li>
                <?php endif ?>
                <li class="nav-item dropdown">
                    <?= Html::a(FA::icon('sign-out', ['class' => 'icon', 'aria-hidden' => 'true']),
                        ['/site/' . (Yii::$app->user->isGuest ? 'login' : 'logout')], [
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

                    <li class="site-menu-item">
                        <?= Html::a('<i class="icon wb-user" aria-hidden="true"></i>
                            <span class="site-menu-title">Me</span>', ['/'], ['class' => $user->getIsAllowedLinkClass()]) ?>
                    </li>

                    <li class="dropdown site-menu-item has-sub">
                        <a data-toggle="dropdown" href="javascript:void(0)" data-dropdown-toggle="false">
                            <i class="site-menu-icon wb-layout" aria-hidden="true"></i>
                            <span class="site-menu-title">Discover</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="site-menu-scroll-wrap is-list">
                                <div>
                                    <div>
                                        <ul class="site-menu-sub site-menu-normal-list">
                                            <li class="site-menu-item">
                                                <?= Html::a('<i class="icon wb-hammer" aria-hidden="true"></i>
                            <span class="site-menu-title">Projects</span>', ['/project/index'],
                                                    ['class' => 'animsition-link']) ?>
                                            </li>
                                            <li class="site-menu-item has-sub">
                                                <?= Html::a('<i class="icon fa-group" aria-hidden="true"></i>
                            <span class="site-menu-title">Communities</span>', ['/community/index'],
                                                    ['class' => 'animsition-link']) ?>
                                            </li>
                                            <li class="site-menu-item has-sub">
                                                <?= Html::a('<i class="icon fa-briefcase" aria-hidden="true"></i>
                            <span class="site-menu-title">Companies</span>', ['/company/index'],
                                                    ['class' => 'animsition-link']) ?>
                                            </li>
                                            <li class="site-menu-item">
                                                <?= Html::a('<i class="icon wb-users" aria-hidden="true"></i>
                            <span class="site-menu-title">People</span>', ['/person/index'],
                                                    ['class' => 'animsition-link']) ?>
                                            </li>
                                            <li class="site-menu-item has-sub">
                                                <?= Html::a('<i class="icon wb-map" aria-hidden="true"></i>
                            <span class="site-menu-title">Locations</span>', ['/site/locations'],
                                                    ['class' => 'animsition-link']) ?>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="site-menu-item">
                        <?= Html::a('<i class="icon wb-shopping-cart" aria-hidden="true"></i>
                            <span class="site-menu-title">Marketplace</span>', ['/marketplace']) ?>
                    </li>

                    <li class="site-menu-item">
                        <a href="javascript:void;">
                            <i class="icon wb-zoom-in" aria-hidden="true"></i>
                            <span class="site-menu-title">Analysis</span>
                        </a>
                    </li>

                    <li class="site-menu-item">
                        <?= Html::a('<i class="icon fa-newspaper-o" aria-hidden="true"></i>
                            <span class="site-menu-title">News feed</span>', ['/project/news']) ?>
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

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
