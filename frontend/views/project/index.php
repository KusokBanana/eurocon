<?php
/* @var $this yii\web\View */
/* @var $projects \frontend\models\Project */
/* @var $person \frontend\models\Person */
/* @var $tags array */
use yii\helpers\Html;

//$this->registerJsFile('@web/js/Plugin/filterable.min.js', ['position' => yii\web\View::POS_READY]);
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
                    <div class="font-size-70 m-b-30 blue-grey-800"><?= $person->name ?>'s Projects</div>
                    <?= Html::a('<span><i class="icon wb-hammer" aria-hidden="true"></i>Create a project</span>',
                        ['create'], ['class' => 'btn btn-dark btn-animate btn-animate-side']) ?>
                </div>
            </div>
            <!-- End Team Total Completed -->

            <!-- Personal -->
        </div>

        <!-- End Personal -->
        <!-- To Do List -->
        <div class="col-xs-12 col-xxl-12  col-xl-12 col-lg-12">
            <div class="page-header page-header-bordered page-header-tabs">

                <div class="form-group">
                    <div class="input-search">
                        <button class="input-search-btn" id="filter-search-btn">
                            <i class="icon wb-search" aria-hidden="true"></i>
                        </button>
                        <input type="text" class="form-control" id="projects-search-filter" name="" placeholder="Search...">
                    </div>
                </div>
                <div class="page-header-actions"></div>
                <ul class="nav nav-tabs nav-tabs-line" role="tablist" id="projectsFilter">
                    <li class="nav-item" role="presentation">
                        <a class="active nav-link" href="#" aria-controls="exampleList" aria-expanded="true"
                           role="tab" data-filter="*">All</a>
                    </li>
                    <?php
                    if (!empty($tags['values'])):
                        foreach ($tags['values'] as $key => $tag): ?>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="#" aria-expanded="false"
                           role="tab" data-filter=".item_filter_<?= $key ?>"><?= $tag ?></a>
                    </li>
                    <?php
                        endforeach;
                    endif; ?>
                </ul>
            </div>
            <div class="page-content">
                <ul class="blocks blocks-100 blocks-xxl-10 blocks-lg-3 blocks-md-2" data-plugin="filterable"
                    data-filters="#projectsFilter">
                    <?php foreach ($projects as $project): ?>
                        <li class="<?= $tags['classes'][$project->id] ?>" data-search="<?= $project->name ?>">
                            <div class="card card-shadow">
                                <figure class="card-img-top overlay-hover overlay">
                                    <?= Html::img($project->image_show, [
                                            'class' => 'overlay-figure overlay-scale',
                                            'alt' => '...'
                                    ]) ?>
                                    <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                                        <a href="<?= $project->image_show ?>" class="icon wb-search"></a>
                                    </figcaption>
                                </figure>
                                <div class="card-block">
                                    <?= Html::a('<h4 class="card-title">' . $project->name . '</h4>',
                                        ['/project/view', 'id' => $project->id]) ?>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div>
        <!-- End To Do List -->
        <!-- Recent Activity -->

        <!-- End Recent Activity -->
        <!-- End Second Row -->
    </div>
</div>

