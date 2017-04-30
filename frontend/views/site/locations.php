<?php

/* @var $this \yii\web\View */

//$this->registerJsFile('@web/vendor/jquery.raty.js', ['position' => yii\web\View::POS_END]);
//$this->registerJsFile('@web/js/Plugin/raty.min.js', ['position' => yii\web\View::POS_END]);
//$this->registerJsFile('@web/js/assets/Travel.min.js', ['position' => yii\web\View::POS_END]);
//$this->registerJsFile('@web/js/Plugin/travel.min.js', ['position' => yii\web\View::POS_END]);

use yii\helpers\Url;

$this->registerCssFile('@web/vendor/mapbox-js/mapbox.min.css');
$this->registerCssFile('@web/css/travel.min.css');

?>

<div class="page-header h-300 m-b-30"
     style="background-image: url(<?= Url::to('@web/img/layer_images/locations-background.png') ?>);
     background-size: cover;">
    <div class="text-xs-center blue-grey-800 m-t-50 m-xs-0">
        <div class="font-size-70 m-b-30 blue-grey-800" style="background-color: rgba(232, 241, 248, 0.7);">Locations</div>
    </div>
</div>

<!-- Page -->
<div class="page">

    <!-- Travel Options Siderbar -->
    <div class="page-aside">

        <div class="form-group">
            <div class="input-search">
                <i class="input-search-icon wb-search" aria-hidden="true"></i>
                <input type="text" class="form-control" name="" placeholder="Search...">
                <button type="button" class="input-search-close icon wb-close" aria-label="Close"></button>
            </div>
        </div>


        <div class="page-aside-switch">
            <i class="icon wb-chevron-left" aria-hidden="true"></i>
            <i class="icon wb-chevron-right" aria-hidden="true"></i>
        </div>
        <div class="page-aside-inner nav-tabs-animate">
            <div class="page-nav-tabs">
                <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-toggle="tab" href="#spots" aria-controls="travel-spots"
                           aria-expanded="false" role="tab">Projects</a>
                    </li>
                </ul>
            </div>
            <div class="page-aside-content page-aside-scroll">
                <div data-role="container">
                    <div data-role="content">
                        <div class="tab-content">
                            <div class="tab-pane animation-fade active" id="spots" role="tabpanel" aria-expanded="ture">
                                <div class="spots-list row">
                                    <div class="col-xs-12 col-xxl-6 col-lg-12 spot-info" data-spot-id="s_1">
                                        <div class="card card-shadow">
                                            <div class="card-header cover overlay">
                                                <img class="cover-image" src="https://s-media-cache-ak0.pinimg.com/originals/f2/6e/58/f26e5892246118a65bc91782e4c3b40a.jpg" alt="spot_photo"
                                                />
                                                <div class="overlay-panel">
                                                    <div class="card-actions pull-xs-right">
                                                        <a href="javascript:void(0)">
                                                            <i class="icon wb-heart-outline text" aria-hidden="true"></i>
                                                            <i class="icon wb-heart text-active" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-block">
                                                <h3 class="card-title item-title">
                                                    Project №1
                                                </h3>
                                                <span class="item-name">
                            exercitation
                          </span>
                                                <p class="card-text type-link">
                                                    <small>
                                                        Posted in
                                                        <a href="javascript:void(0)">
                                                            qui
                                                        </a>
                                                    </small>
                                                </p>
                                                <p class="card-text">
                                                    Officia et adipisicing esse enim aliqua. Ut irure non pariatur reprehenderit cupidatat
                                                    tempor. Cillum dolor elit aliquip est aute qui est.
                                                    Consectetur irure consequat sunt et est nostrud laborum
                                                    proident eu. Ipsum est laborum adipisicing pariatur
                                                    ut sit do consectetur. Deserunt aliqua est magna duis
                                                    enim qui et ea. Aliqua consequat consequat officia
                                                    proident in. Occaecat tempor dolore nulla consequat
                                                    id.
                                                </p>
                                            </div>
                                            <div class="card-block">
                                                <div class="rating" data-score="4" data-nummber="5" data-plugin="rating">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane animation-fade" id="hotels" role="tabpanel" aria-expanded="false">
                                <div class="hotels-list row">
                                    <div class="col-xs-12 col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 hotel-info"
                                         data-hotel-id="h_1">
                                        <div class="card card-block card-inverse card-primary">
                                            <div class="hotel-img">
                                                <img src= "../../global/photos/city-4-720x480.jpg">
<!--                                                --><?//= \yii\helpers\Html::img('@web/') ?>
                                            </div>
                                            <h4 class="card-title item-name">
                                                sint consequat
                                            </h4>
                                            <p class="card-text item-title">
                                                Amet ex velit elit consequat cillum. Proident ex ipsum ipsum et esse sint. Exercitation
                                                nostrud incididunt non dolore fugiat ea.
                                            </p>
                                            <div class="rating" data-plugin="rating" data-score="4" data-nummber="5" data-read-only="true">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Travel Options Siderbar -->
    <div class="page-main">
        <div id="map">
        </div>
    </div>
</div>