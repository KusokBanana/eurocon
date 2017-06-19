<?php

/* @var $this yii\web\View */
/* @var $name string */

use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);
$this->title = 'Page Not Found!';
$this->registerCssFile('@web/css/errors.min.css');
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
    <head>
        <?= $this->render('/layouts/head') ?>
    </head>
    <body class="animsition page-error page-error-404 layout-full">
    <?php $this->beginBody() ?>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!-- Page -->
        <div class="page vertical-align text-center"
             data-animsition-in="fade-in" data-animsition-out="fade-out">
            <div class="col-xs-4"></div>
            <div class="page-content vertical-align-middle p-30 col-xs-4" style="text-align: center;">
                <header class="text-center">
                    <h1 class="animation-slide-top">404</h1>
                    <p>Page Not Found !</p>
                </header>
                <?= Html::a('BACK TO HOME PAGE', ['/'], ['class' => 'btn btn-primary btn-round']) ?>
                <footer class="page-copyright">
                    <p>© 2017. EUROCON.</p>
                </footer>
            </div>
        </div>
    <!-- End Page -->
    <!-- Core  -->
    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>