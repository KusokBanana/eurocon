<?php

/* @var $projects \frontend\models\AjaxReload */

use frontend\models\MarketplaceItem;
use frontend\models\Project;
use frontend\widgets\Pagination;
use frontend\widgets\Search;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;

$isGuest = Yii::$app->user->isGuest;
?>
<div class="panel">
    <div class="panel-body">
        <?= Search::widget([
            'extraData' => $projects->extraData,
            'query' => $projects->getSearch(),
            'data' => $projects->data,
            'type' => $projects->type
        ]) ?>

        <br>

        <?= Html::beginForm(['ajax-reload', 'type' => $projects->type, 'page' => $projects->page], 'post',
            [
                'class' => 'ajax-reload-filter',
                'data-wrapSelector' => $projects->extraData['wrapSelector'],
                'data-addition' => Json::encode($projects->extraData)
            ]) ?>
            <div class="col-md-12">
                <!-- Example Basic -->
                <div class="example-wrap m-lg-0">

                    <div class="row m-t-5 m-b-5">
                        <div class="col-xs-1">
                            <?= Html::label(Project::$types[1], 'type_id-1',
                                ['class' => 'p-t-3']) ?>
                        </div>
                        <div class="m-r-20 col-xs-1 p-t-3">
                            <?= Html::checkbox('type_id-1', $projects->getFilterVal('type_id-1'),
                                [
                                    'class' => 'js-switch',
                                    'value' => 1
                                ]) ?>
                        </div>

                        <div class="col-xs-1">
                            <?= Html::label(Project::$types[2], 'type_id-2',
                                ['class' => 'p-t-3 m-l-25']) ?>
                        </div>
                        <div class="m-r-20 col-xs-1 p-t-3">
                            <?= Html::checkbox('type_id-2', $projects->getFilterVal('type_id-2'),
                                [
                                    'class' => 'js-switch',
                                    'value' => 2
                                ]) ?>
                        </div>

                        <div class="col-xs-1">
                            <?= Html::label(Project::$types[3], 'type_id-3',
                                ['class' => 'p-t-3 m-l-25']) ?>
                        </div>
                        <div class="m-r-20 col-xs-1 p-t-3">
                            <?= Html::checkbox('type_id-3', $projects->getFilterVal('type_id-3'), [
                                'class' => 'js-switch',
                                'value' => 3
                            ]) ?>
                        </div>
                    </div>
                    <br>
                    <div class="row m-t-5 m-b-5">
                        <div class="form-group col-xs-4">
                            <?= Html::label('Status', 'status_id',
                                ['class' => 'form-control-label col-xs-12 col-md-2']) ?>
                            <div class="col-md-9 col-xs-12">
                                <?= Html::dropDownList('status_id', $projects->getFilterVal('status_id'),
                                    Project::$statuses,
                                    ['class' => 'form-control', 'prompt' => '-']) ?>
                            </div>
                        </div>

                        <div class="form-group  col-xs-4">
                            <?= Html::label('Budget', 'budget_id',
                                ['class' => 'form-control-label col-xs-12 col-md-3']) ?>
                            <div class="col-md-9 col-xs-12">
                                <?= Html::dropDownList('budget_id', $projects->getFilterVal('budget_id'),
                                    Project::$budgets,
                                    ['class' => 'form-control', 'prompt' => '-']) ?>
                            </div>
                        </div>

                        <div class="form-group  col-xs-4">
                            <?= Html::label('Category', 'category_id',
                                ['class' => 'form-control-label col-xs-12 col-md-3']) ?>
                            <div class="col-md-9 col-xs-12">
                                <?= Html::dropDownList('category_id', $projects->getFilterVal('category_id'),
                                    Project::$categories,
                                    ['class' => 'form-control', 'prompt' => '-']) ?>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- End Example Basic -->
            </div>

        <?= Html::endForm() ?>

    </div>
</div>

<div class="page-content panel-bordered panel">
    <div class="panel-heading"><h3 class="panel-title"><?= $isGuest ? 'All' : 'My' ?> projects</h3></div>
    <div class="panel-body">

        <?php if (!empty($projects->data)): ?>
            <ul class="blocks blocks-100 blocks-xxl-10 blocks-lg-3 blocks-md-2 m-b-0">
                <?php foreach ($projects->data as $key => $project): ?>

                <?php
                if (!$key && $project->search_type_id == 1 && !$isGuest){
                    echo "<p>You don't have communities for this search</p>";
                }

                $prevItemSearchId = 0;
                if (isset($projects->data[$key-1]))
                    $prevItemSearchId = ArrayHelper::getValue($projects->data[$key-1], 'search_type_id');

                if ($prevItemSearchId == 0 && $project['search_type_id'] == 1): ?>
            </ul>
        <?php if (!$isGuest): ?>
    </div>
</div>
<br>
<div class="page-content panel panel-bordered">
    <div class="panel-heading"><h3 class="panel-title">All projects</h3></div>
    <div class="panel-body">
        <?php endif; ?>
        <ul class="blocks blocks-100 blocks-xxl-10 blocks-lg-3 blocks-md-2">
            <?php endif; ?>
                <li class="clearfix">
                    <div class="card card-shadow" style="height: 420px;">
                        <figure class="card-img-top overlay-hover overlay">
                            <?= Html::img($project->imageShow, [
                                'class' => 'overlay-figure overlay-scale',
                                'alt' => '...',
                                'height' => '310px'
                            ]) ?>
                            <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                                <a href="<?= $project->imageShow ?>" class="icon wb-search"></a>
                            </figcaption>
                        </figure>
                        <div class="card-block">
                            <?= Html::a('<h4 class="card-title">' . $project->name . '</h4>',
                                ['/project/view', 'id' => $project->id], ['class' => 'no-underline']) ?>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>

            <?= Pagination::widget($projects->pagination) ?>

        <?php elseif (!$projects->getSearch()): ?>
            <p>You don't have projects in the moment. <?= Html::a('Create project', ['create']) ?>
                or subscribe to one of the existing</p>
        <?php elseif ($projects->getSearch()): ?>
            <p>You don't have projects for this search</p>
        <?php endif; ?>
    </div>
</div>