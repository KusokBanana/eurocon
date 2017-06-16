<?php

/* @var $communities \frontend\models\AjaxReload */

use frontend\widgets\Pagination;
use frontend\widgets\Search;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

?>
<div class="panel">
    <div class="panel-body">
        <?= Search::widget([
            'extraData' => $communities->extraData,
            'query' => $communities->getSearch(),
            'data' => $communities->data,
            'type' => $communities->type
        ]) ?>
    </div>
</div>
<div class="panel-bordered panel">
    <div class="panel-heading"><h3 class="panel-title">My communities</h3></div>
    <div class="panel-body">

        <?php if (!empty($communities->data)): ?>
            <ul class="list-group">
                <?php foreach ($communities->data as $key => $community): ?>

                    <?php
                    if (!$key && $community->search_type_id == 1){
                        echo "<p>You don't have communities for this search</p>";
                    }

                    $prevItemSearchId = 0;
                    if (isset($communities->data[$key-1]))
                        $prevItemSearchId = ArrayHelper::getValue($communities->data[$key-1], 'search_type_id');

                    if ($prevItemSearchId == 0 && $community['search_type_id'] == 1): ?>
            </ul>
    </div>
</div>
<br>
<div class="panel panel-bordered">
    <div class="panel-heading"><h3 class="panel-title">All Communities</h3></div>
    <div class="panel-body">
        <ul class="list-group">
            <?php endif; ?>
                <li class="list-group-item">
                    <div class="media">
                        <div class="media-left">
                            <div class="avatar avatar-online">
                                <?= Html::a(Html::img($community->imageShow, [
                                    'alt' => '...'
                                ]), ['view', 'id' => $community->id]) ?>
                            </div>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><?= $community->name ?></h4>
<!--                            <p>-->
<!--                                <i class="icon icon-color wb-map" aria-hidden="true"></i>-->
<!--                            </p>-->
                        </div>
                    </div>
                </li>
        <?php endforeach; ?>
    </ul>

    <?= Pagination::widget($communities->pagination) ?>

        <?php elseif (!$communities->getSearch()): ?>
            <p>You don't have communities in the moment. <?= Html::a('Create community', ['create']) ?>
                or subscribe to one of the existing</p>
        <?php elseif ($communities->getSearch()): ?>
            <p>You don't have communities for this search</p>
        <?php endif; ?>
    </div>
</div>