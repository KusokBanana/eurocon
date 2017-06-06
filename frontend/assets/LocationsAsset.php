<?php

namespace frontend\assets;
use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class LocationsAsset extends AssetBundle
{

    public $css = [
        '/css/site.min.css',
        // plugins
        '/vendor/animsition/animsition.min.css',
        '/vendor/asscrollable/asScrollable.min.css',
//        '/vendor/switchery/switchery.min.css',
        '/vendor/switchery-master/dist/switchery.min.css',
        '/vendor/intro-js/introjs.min.css',
        '/vendor/slidepanel/slidePanel.min.css',
        '/vendor/flag-icon-css/flag-icon.min.css',
        '/vendor/chartist/chartist.min.css',
        '/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.min.css',
        '/vendor/aspieprogress/asPieProgress.min.css',
        '/vendor/jquery-selective/jquery-selective.min.css',
        '/vendor/bootstrap-datepicker/bootstrap-datepicker.min.css',
        '/css/team.min.css',
        // fonts
        '/fonts/web-icons/web-icons.min.css',
        '/fonts/brand-icons/brand-icons.min.css',
        '/vendor/mapbox-js/mapbox.min.css',
        '/css/travel.min.css',
    ];



    public $js = [
        '/vendor/babel-external-helpers/babel-external-helpers.js',
        '/vendor/animsition/animsition.min.js',
        '/vendor/mousewheel/jquery.mousewheel.min.js',
        '/vendor/asscrollbar/jquery-asScrollbar.min.js',
        '/vendor/asscrollable/jquery-asScrollable.min.js',
//        '/vendor/switchery/switchery.min.js',
        '/vendor/intro-js/intro.min.js',
        '/vendor/screenfull/screenfull.min.js',
        '/vendor/slidepanel/jquery-slidePanel.min.js',
        '/vendor/raty/jquery.raty.js',
        '/vendor/slidepanel/jquery-slidePanel.min.js',
        '/vendor/mapbox-js/mapbox.js',
        '/vendor/mapbox-js/leaflet.markercluster.js',
        '/js/State.min.js',
        '/js/Component.min.js',
        '/js/Plugin.min.js',
        '/js/Base.min.js',
        '/js/Config.min.js',
        '/js/assets/Menubar.min.js',
        '/js/assets/Sidebar.min.js',
        '/js/assets/PageAside.min.js',
//        '/js/Plugin/switchery.min.js',
        '/js/config/colors.min.js',
        '/js/config/tour.min.js',
        '/js/Plugin/raty.min.js',
        '/js/assets/Site.min.js',
        '/js/assets/Travel.js',
        '/js/Plugin/travel.min.js',
        '/vendor/switchery-master/dist/switchery.js',
        '/vendor/switchery-master/start.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'rmrevin\yii\fontawesome\AssetBundle',
        'yii\web\JqueryAsset'
    ];

}
