<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap-extent.min.css',
        'css/site.min.css',
        // plugins
        'css/site.min.css',
        'css/site.min.css',
        'css/site.min.css',
        'css/site.min.css',
        'css/site.min.css',
        'css/site.min.css',
        'css/site.min.css',

    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
/*<link rel="stylesheet" href="../../global/vendor/animsition/animsition.css">
  <link rel="stylesheet" href="../../global/vendor/asscrollable/asScrollable.css">
  <link rel="stylesheet" href="../../global/vendor/switchery/switchery.css">
  <link rel="stylesheet" href="../../global/vendor/intro-js/introjs.css">
  <link rel="stylesheet" href="../../global/vendor/slidepanel/slidePanel.css">
  <link rel="stylesheet" href="../../global/vendor/flag-icon-css/flag-icon.css">
  <link rel="stylesheet" href="../../global/vendor/chartist/chartist.css">
  <link rel="stylesheet" href="../../global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css">
  <link rel="stylesheet" href="../../global/vendor/aspieprogress/asPieProgress.css">
  <link rel="stylesheet" href="../../global/vendor/jquery-selective/jquery-selective.css">
  <link rel="stylesheet" href="../../global/vendor/bootstrap-datepicker/bootstrap-datepicker.css">
  <link rel="stylesheet" href="../assets/examples/css/dashboard/team.css">*/
