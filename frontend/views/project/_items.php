<?php

/* @var $projects \frontend\models\AjaxReload */

use frontend\widgets\Pagination;
use frontend\widgets\Search;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

?>
<div class="panel">
    <div class="panel-body">
        <?= Search::widget([
            'extraData' => $projects->extraData,
            'query' => $projects->getSearch(),
            'data' => $projects->data,
            'type' => $projects->type
        ]) ?>
    </div>
</div>
<div class="page-content panel-bordered panel">
    <div class="panel-heading"><h3 class="panel-title">My projects</h3></div>
    <div class="panel-body">

        <?php if (!empty($projects->data)): ?>
            <ul class="blocks blocks-100 blocks-xxl-10 blocks-lg-3 blocks-md-2">
                <?php foreach ($projects->data as $key => $project): ?>

                <?php
                if (!$key && $project->search_type_id == 1){
                    echo "<p>You don't have communities for this search</p>";
                }

                $prevItemSearchId = 0;
                if (isset($projects->data[$key-1]))
                    $prevItemSearchId = ArrayHelper::getValue($projects->data[$key-1], 'search_type_id');

                if ($prevItemSearchId == 0 && $project['search_type_id'] == 1): ?>
            </ul>
    </div>
</div>
<br>
<div class="page-content panel panel-bordered">
    <div class="panel-heading"><h3 class="panel-title">All projects</h3></div>
    <div class="panel-body">
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
            <p>You don't have communities in the moment. <?= Html::a('Create community', ['create']) ?>
                or subscribe to one of the existing</p>
        <?php elseif ($projects->getSearch()): ?>
            <p>You don't have communities for this search</p>
        <?php endif; ?>
    </div>
</div>