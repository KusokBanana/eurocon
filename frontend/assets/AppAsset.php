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
        // plugins
        '/vendor/animsition/animsition.min.css',
        '/vendor/asscrollable/asScrollable.min.css',
        '/vendor/intro-js/introjs.min.css',
//        'vendor/jquery-slidePanel/dist/css/slidePanel.min.css',
        '/vendor/slidepanel/slidePanel.css',
        '/css/site.min.css',
        '/vendor/flag-icon-css/flag-icon.min.css',
        '/vendor/chartist/chartist.min.css',
        '/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.min.css',
        '/vendor/aspieprogress/asPieProgress.min.css',
        '/vendor/jquery-selective/jquery-selective.min.css',
        '/vendor/bootstrap-datepicker/bootstrap-datepicker.min.css',
        '/css/team.min.css',
        '/css/media.min.css',
        '/css/message.min.css',
        '/vendor/sliptree-bootstrap-tokenfield/dist/css/bootstrap-tokenfield.min.css',
        '/vendor/sliptree-bootstrap-tokenfield/dist/css/tokenfield-typeahead.min.css',
        '/vendor/plugin_select2/dist/css/select2.min.css',
        // fonts
        '/fonts/web-icons/web-icons.min.css',
        '/fonts/brand-icons/brand-icons.min.css',
    ];
    public $js = [
        // Core
        '/vendor/babel-external-helpers/babel-external-helpers.js',
        '/vendor/animsition/animsition.min.js',
        '/vendor/mousewheel/jquery.mousewheel.min.js',
        '/vendor/asscrollbar/jquery-asScrollbar.min.js',
        '/vendor/asscrollable/jquery-asScrollable.min.js',
        // Plugins
        '/vendor/intro-js/intro.min.js',
        '/vendor/screenfull/screenfull.min.js',
        '/vendor/slidepanel/jquery-slidePanel.js',
        '/vendor/raty/jquery.raty.js',
        '/vendor/chartist/chartist.min.js',
        '/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.min.js',
        '/vendor/aspieprogress/jquery-asPieProgress.min.js',
        '/vendor/matchheight/jquery.matchHeight-min.js',
        '/vendor/jquery-selective/jquery-selective.min.js',
        '/vendor/bootstrap-datepicker/bootstrap-datepicker.min.js',
        '/vendor/jquery-placeholder/jquery.placeholder.min.js',
        '/vendor/screenfull/screenfull.js', // -
        // Scripts
        '/js/State.min.js',
        '/js/Component.min.js',
        '/js/Plugin.min.js',
        '/js/Base.min.js',
        '/js/Config.min.js',
        '/js/assets/Menubar.min.js',
        '/js/assets/Sidebar.min.js',
        '/js/assets/PageAside.min.js',
        '/js/assets/Section/GridMenu.js',
        '/vendor/breakpoints/breakpoints.min.js',
        '/js/breakpoints.run.js',
        // Config
        '/js/config/colors.min.js',
        '/js/config/tour.min.js',
        // Page
        '/js/assets/Site.min.js',
        '/js/Plugin/asscrollable.min.js',
        '/js/Plugin/matchheight.min.js',
        '/js/Plugin/aspieprogress.min.js',
        '/js/Plugin/bootstrap-datepicker.min.js',
        '/js/Plugin/animate-list.min.js',
        '/js/Plugin/filterable.js',
        '/js/Plugin/gallery.min.js',
        '/vendor/isotope/isotope.pkgd.min.js',
        '/vendor/magnific-popup/jquery.magnific-popup.min.js',
        '/js/Plugin/sticky-header.min.js',
        '/js/Plugin/action-btn.min.js',
        '/js/Plugin/asselectable.min.js',
        '/js/Plugin/selectable.min.js',
        '/js/BaseApp.min.js',
        '/js/Media.js',
        '/vendor/autosize/autosize.js', // -
        '/js/assets/media.js',
        '/vendor/formvalidation/formValidation.js',
        '/vendor/formvalidation/framework/bootstrap.js',
        '/vendor/jquery-match-height/jquery.matchHeight-min.js',
        '/vendor/jquery-wizard/jquery-wizard.min.js',
        '/js/assets/matchheight.min.js',
        '/js/Plugin/jquery-wizard.min.js',
        '/vendor/forms/wizard.js',
        '/vendor/sliptree-bootstrap-tokenfield/dist/bootstrap-tokenfield.min.js',
        '/js/Message.js',
        '/js/Plugin/message.js',
        '/vendor/plugin_select2/dist/js/select2.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'rmrevin\yii\fontawesome\AssetBundle',
        'yii\web\JqueryAsset'
    ];
}
