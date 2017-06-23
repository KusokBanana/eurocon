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
$this->registerJsFile('@web/js/ajaxReload.js', ['depends' => AppAsset::className()]);
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
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
    <!--[if lt IE 9]>
    <script src="../../web/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->
    <!--[if lt IE 10]>
    <script src="../../web/vendor/media-match/media.match.min.js"></script>
    <script src="../../web/vendor/respond/respond.min.js"></script>
    <![endif]-->
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
            <?php if (!(isset($this->params['footer_icons_remove']) && $this->params['footer_icons_remove'])): ?>
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
            <?php endif; ?>
        </footer>
    </div>
</div>
<!-- End Page -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
