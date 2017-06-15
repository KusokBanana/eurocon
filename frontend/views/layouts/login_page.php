<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\models\Person;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
$user = Person::get(Yii::$app->user);
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
<!--    --><?php //$this->registerJsFile('@web/vendor/jquery-placeholder/jquery.placeholder.min.js', [['position' => yii\web\View::POS_LOAD]]) ?>
    <?php $this->registerJs('(function(document, window, $) {
            \'use strict\';
            var Site = window.Site;
            $(document).ready(function() {
                Site.run();
            });
        })(document, window, jQuery);') ?>
    <?php $this->head() ?>
</head>
<body class="animsition <?= $this->params['body-class'] ?> layout-full">
<?php $this->beginBody() ?>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<!-- Page -->

<div class="page vertical-align text-xs-center" data-animsition-in="fade-in" data-animsition-out="fade-out">
    <div class="page-content vertical-align-middle">

        <?= $content ?>

        <footer class="page-copyright page-copyright-inverse">

            <div class="social">
                <a href="javascript:void(0)">
                    <i class="icon bd-twitter" aria-hidden="true"></i>
                </a>
                <a href="javascript:void(0)">
                    <i class="icon bd-facebook" aria-hidden="true"></i>
                </a>
                <a href="javascript:void(0)">
                    <i class="icon bd-dribbble" aria-hidden="true"></i>
                </a>
            </div>
        </footer>
    </div>
</div>
<!-- End Page -->
<!-- Core  -->
<!--    <script src="../../global/vendor/babel-external-helpers/babel-external-helpers.js"></script>-->
<!--    <script src="../../global/vendor/jquery/jquery.js"></script>-->
<!--    <script src="../../global/vendor/tether/tether.js"></script>-->
<!--    <script src="../../global/vendor/bootstrap/bootstrap.js"></script>-->
<!--    <script src="../../global/vendor/animsition/animsition.js"></script>-->
<!--    <script src="../../global/vendor/mousewheel/jquery.mousewheel.js"></script>-->
<!--    <script src="../../global/vendor/asscrollbar/jquery-asScrollbar.js"></script>-->
<!--    <script src="../../global/vendor/asscrollable/jquery-asScrollable.js"></script>-->
<!--    <!-- Plugins -->-->
<!--    <script src="../../global/vendor/switchery/switchery.min.js"></script>-->
<!--    <script src="../../global/vendor/intro-js/intro.js"></script>-->
<!--    <script src="../../global/vendor/screenfull/screenfull.js"></script>-->
<!--    <script src="../../global/vendor/slidepanel/jquery-slidePanel.js"></script>-->
<!--    <script src="../../global/vendor/jquery-placeholder/jquery.placeholder.js"></script>-->
<!--    <!-- Scripts -->-->
<!--    <script src="../../global/js/State.js"></script>-->
<!--    <script src="../../global/js/Component.js"></script>-->
<!--    <script src="../../global/js/Plugin.js"></script>-->
<!--    <script src="../../global/js/Base.js"></script>-->
<!--    <script src="../../global/js/Config.js"></script>-->
<!--    <script src="../assets/js/Section/Menubar.js"></script>-->
<!--    <script src="../assets/js/Section/Sidebar.js"></script>-->
<!--    <script src="../assets/js/Section/PageAside.js"></script>-->
<!--    <script src="../assets/js/Plugin/menu.js"></script>-->
<!--    <!-- Config -->-->
<!--    <script src="../../../global/js/config/colors.js"></script>-->
<!--    <script src="../../assets/js/config/tour.js"></script>-->
<!--    <script>-->
<!--        Config.set('assets', '../../assets');-->
<!--    </script>-->
<!--    <!-- Page -->-->
<!--    <script src="../assets/js/Site.js"></script>-->
<!--    <script src="../../global/js/Plugin/asscrollable.js"></script>-->
<!--    <script src="../../global/js/Plugin/slidepanel.js"></script>-->
<!--    <script src="../../global/js/Plugin/switchery.js"></script>-->
<!--    <script src="../../global/js/Plugin/jquery-placeholder.js"></script>-->
<!--    <script src="../../global/js/Plugin/animate-list.js"></script>-->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
