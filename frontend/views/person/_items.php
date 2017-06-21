<?php

/* @var $persons \frontend\models\AjaxReload */
/* @var $person Person */

use frontend\models\Person;
use frontend\widgets\Pagination;
use frontend\widgets\Search;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$isGuest = Yii::$app->user->isGuest;
?>
<div class="panel">
    <div class="panel-body">
<?= Search::widget([
    'extraData' => $persons->extraData,
    'query' => $persons->getSearch(),
    'data' => $persons->data,
    'type' => $persons->type
]) ?>
    </div>
</div>
<div class="panel-bordered panel">
    <div class="panel-heading"><h3 class="panel-title"><?= $isGuest ? 'All' : 'My' ?> people</h3></div>
    <div class="panel-body">

        <?php if (!empty($persons->data)): ?>
            <ul class="list-group m-b-0">
                <?php /** @var \frontend\models\Person $person */
                foreach ($persons->data as $key => $person): ?>

                    <?php
                    if (!$key && $person->search_type_id == 1 && !$isGuest){
                        echo "<p>You don't have people for this search</p>";
                    }

                    $prevItemSearchId = 0;
                    if (isset($persons->data[$key-1]))
                        $prevItemSearchId = ArrayHelper::getValue($persons->data[$key-1], 'search_type_id');

                    if ($prevItemSearchId == 0 && $person->search_type_id == 1): ?>
            </ul>
        <?php if (!$isGuest): ?>
    </div>
</div>
<br>
<div class="panel panel-bordered">
    <div class="panel-heading"><h3 class="panel-title">All people</h3></div>
    <div class="panel-body">
        <?php endif; ?>
        <ul class="list-group">
            <?php endif; ?>
            <li class="list-group-item">
                <div class="media">
                    <div class="media-left">
                        <?= Html::a("<div class=\"avatar ". ($person->is_online ?
                                'avatar-online' : 'avatar-away') . " \">".
                            Html::img($person->imageShow,
                                ['alt' => '...']) .
                            "<i></i>".
                            "</div>",
                            ['profile', 'id' => $person->id]) ?>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">
                            <?= $person->full_name ?>
                            <small>Last Access: <?= $person->last_access ?></small>
                        </h4>
                        <p>
                            <i class="icon icon-color wb-map" aria-hidden="true"></i>
                            <?= $person->location['name'] ?>
                        </p>
                    </div>
                    <?php if ($person->relation == Person::RELATION_FOLLOWING): ?>
                        <div class="media-right p-t-10">
                            <?= Html::a('unfollow', ['/person/un-follow', 'id' => $person->id],
                                ['class' => 'btn btn-outline btn-default btn-sm']) ?>
                        </div>
                    <?php elseif ($person->relation != Person::RELATION_SELF): ?>
                        <div class="media-right p-t-10">
                            <?= Html::a('follow', ['/person/follow', 'id' => $person->id],
                                ['class' => 'btn btn-outline btn-primary btn-sm ' .
                                    $person->getIsAllowedLinkClass()]) ?>
                        </div>
                    <?php endif; ?>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>

    <?= Pagination::widget($persons->pagination) ?>

        <?php elseif (!$persons->getSearch()): ?>
            <p>You don't have people in the moment</p>
        <?php elseif ($persons->getSearch()): ?>
            <p>You don't have people for this search</p>
        <?php endif; ?>
    </div>
</div>