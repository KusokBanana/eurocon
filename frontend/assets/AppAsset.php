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
//        'css/bootstrap.min.css',
//        'css/bootstrap-extend.min.css',
        'css/site.min.css',
        // plugins
        'vendor/animsition/animsition.min.css',
        'vendor/asscrollable/asScrollable.min.css',
        'vendor/switchery/switchery.min.css',
        'vendor/intro-js/introjs.min.css',
        'vendor/slidepanel/slidePanel.min.css',
        'vendor/flag-icon-css/flag-icon.min.css',
        'vendor/chartist/chartist.min.css',
        'vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.min.css',
        'vendor/aspieprogress/asPieProgress.min.css',
        'vendor/jquery-selective/jquery-selective.min.css',
        'vendor/bootstrap-datepicker/bootstrap-datepicker.min.css',
        'css/team.min.css',
        // fonts
        'fonts/web-icons/web-icons.min.css',
        'fonts/brand-icons/brand-icons.min.css',


    ];
    public $js = [
        // Core
        'vendor/babel-external-helpers/babel-external-helpers.js',
//        'vendor/jquery/jquery.min.js',
//        'vendor/tether/tether.min.js',
//        'vendor/bootstrap/bootstrap.min.js',
        'vendor/animsition/animsition.min.js',
        'vendor/mousewheel/jquery.mousewheel.min.js',
        'vendor/asscrollbar/jquery-asScrollbar.min.js',
        'vendor/asscrollable/jquery-asScrollable.min.js',
        // Plugins
        'vendor/switchery/switchery.min.js',
        'vendor/intro-js/intro.min.js',
        'vendor/screenfull/screenfull.min.js',
        'vendor/slidepanel/jquery-slidePanel.min.js',
        'vendor/chartist/chartist.min.js',
        'vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.min.js',
        'vendor/aspieprogress/jquery-asPieProgress.min.js',
        'vendor/matchheight/jquery.matchHeight-min.js',
        'vendor/jquery-selective/jquery-selective.min.js',
        'vendor/bootstrap-datepicker/bootstrap-datepicker.min.js',
        'vendor/jquery-placeholder/jquery.placeholder.min.js',
        // Scripts
        'js/State.min.js',
        'js/Component.min.js',
        'js/Plugin.min.js',
        'js/Base.min.js',
        'js/Config.min.js',
        'js/assets/Menubar.min.js',
        'js/assets/Sidebar.min.js',
        'js/assets/PageAside.min.js',
        'js/assets/menu.min.js',
        // Config
        'js/config/colors.min.js',
        'js/config/tour.min.js',
        // Page
        '/vendor/breakpoints/breakpoints.min.js',
        'js/assets/Site.min.js',
        'js/Plugin/asscrollable.min.js',
        'js/Plugin/slidepanel.min.js',
        'js/Plugin/switchery.min.js',
        'js/Plugin/matchheight.min.js',
        'js/Plugin/aspieprogress.min.js',
        'js/Plugin/bootstrap-datepicker.min.js',
        'js/Plugin/animate-list.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'rmrevin\yii\fontawesome\AssetBundle',
        'yii\web\JqueryAsset'
    ];
}
