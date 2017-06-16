<?php
/* @var $this yii\web\View */
/* @var $companies \frontend\models\Company array */
/* @var $person \frontend\models\Person */
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="page">
    <div class="page-content container-fluid">
        <div class="row" data-plugin="matchHeight" data-by-row="true">
            <!-- First Row -->
            <!-- Completed Options Pie Widgets -->

            <!-- End Completed Options Pie Widgets -->
            <!-- Team Total Completed -->
            <div class="page-header h-270 m-b-30"
                 style="background-image:
                         url(<?= Url::to(['@web/img/layer_images/communities-background.png']) ?>);
                         background-size: cover;">
                <div class="text-xs-center blue-grey-800 m-t-50 m-xs-0">
                    <div class="font-size-70 m-b-30 blue-grey-800" style="background-color: rgba(232, 241, 248, 0.7);">Companies</div>
                    <?= Html::a('<span><i class="icon wb-home" aria-hidden="true"></i>Create a company</span>',
                        ['create'], ['class' => 'btn btn-dark btn-animate btn-animate-side']); ?>
                </div>

            </div>

            <!-- End Team Total Completed -->
            <!-- End First Row -->
            <!-- Second Row -->
            <!-- Personal -->

        </div>

        <!-- To Do List -->
        <div class="col-xs-12 col-xxl-12  col-xl-12 col-lg-12">
            <div id="companiesWrap">
                <?= $this->render('_items', [
                    'companies' => $companies
                ]) ?>
            </div>
        </div>
        <!-- End To Do List -->

        <!-- Recent Activity -->

        <!-- End Recent Activity -->
        <!-- End Second Row -->
    </div>
</div>

