<?php
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $persons \frontend\models\AjaxReload */
/* @var $person \frontend\models\Person */

?>


<div class="page">
    <div class="page-content container-fluid">
        <div class="row" data-plugin="matchHeight" data-by-row="true">
            <!-- First Row -->
            <!-- Completed Options Pie Widgets -->

            <!-- End Completed Options Pie Widgets -->
            <!-- Team Total Completed -->
            <div class="page-header h-300 m-b-30" style="background-image:
            url(<?= Url::to('@web/img/layer_images/friends-background.png') ?>);  background-size: cover;">
                <div class="text-xs-center blue-grey-800 m-t-50 m-xs-0">
                    <div class="font-size-70 m-b-30 blue-grey-800" style="background-color: rgba(232, 241, 248, 0.7);">People</div>

                </div>
            </div>

            <div class="col-xxl-2 col-xl-2 col-lg-2"></div>
            <div class="col-xs-12 col-xxl-8 col-xl-8 col-lg-8" id="personsWrap">
                <?= $this->render('_items', ['persons' => $persons, 'person' => $person]) ?>
            </div>
            <!-- End Personal -->
            <!-- To Do List -->
        </div>
        <!-- End To Do List -->

        <!-- Recent Activity -->

        <!-- End Recent Activity -->
        <!-- End Second Row -->
    </div>
</div>