<?php
/* @var $this yii\web\View */
/* @var $projects \frontend\models\Project */
/* @var $person \frontend\models\Person */
/* @var $tags array */
use yii\helpers\Html;

$this->registerJsFile('@web/vendor/switchery-master/dist/switchery.js',
    ['depends' => \frontend\assets\AppAsset::className()]);
$this->registerJsFile('@web/vendor/switchery-master/start.js',
    ['depends' => \frontend\assets\AppAsset::className()]);
$this->registerCssFile('@web/vendor/switchery-master/dist/switchery.min.css');
?>

<div class="page">
    <div class="page-content container-fluid">
        <div class="row" data-plugin="matchHeight" data-by-row="true">
            <!-- First Row -->
            <!-- Completed Options Pie Widgets -->

            <!-- End Completed Options Pie Widgets -->
            <!-- Team Total Completed -->
            <div class="page-header h-250 m-b-30"
                 style="background-image: url(<?= \yii\helpers\Url::to('@web/img/layer_images/project-background.png') ?>);  background-size: cover;">
                <div class="text-xs-center blue-grey-800 m-t-0 m-xs-0">
                    <div class="font-size-70 m-b-30 blue-grey-800">Projects</div>
                    <?= Html::a('<span><i class="icon wb-hammer" aria-hidden="true"></i>Create a project</span>',
                        ['create'], ['class' => 'btn btn-dark btn-animate btn-animate-side']) ?>
                </div>
            </div>
            <!-- End Team Total Completed -->

            <!-- Personal -->
        </div>

        <!-- End Personal -->
        <!-- To Do List -->
        <div class="col-xs-12 col-xxl-12  col-xl-12 col-lg-12" id="projectsWrap">

<!--                <div class="page-header-actions"></div>-->
<!--                <ul class="nav nav-tabs nav-tabs-line" role="tablist" id="projectsFilter">-->
<!--                    <li class="nav-item" role="presentation">-->
<!--                        <a class="active nav-link" href="#" aria-controls="exampleList" aria-expanded="true"-->
<!--                           role="tab" data-filter="*">All</a>-->
<!--                    </li>-->
<!--                    --><?php
//                    if (!empty($tags['values'])):
//                        foreach ($tags['values'] as $key => $tag): ?>
<!--                    <li class="nav-item" role="presentation">-->
<!--                        <a class="nav-link" href="#" aria-expanded="false"-->
<!--                           role="tab" data-filter=".item_filter_--><?//= $key ?><!--">--><?//= $tag ?><!--</a>-->
<!--                    </li>-->
<!--                    --><?php
//                        endforeach;
//                    endif; ?>
<!--                </ul>-->

            <?= $this->render('_items', ['projects' => $projects]) ?>

        </div>
        <!-- End To Do List -->
        <!-- Recent Activity -->

        <!-- End Recent Activity -->
        <!-- End Second Row -->
    </div>
</div>

