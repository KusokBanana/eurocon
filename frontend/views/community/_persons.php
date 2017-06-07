<?php

use yii\helpers\Html;
use frontend\widgets\Pagination;
use yii\helpers\Url;
use frontend\widgets\Search;

/* @var $persons \frontend\models\AjaxReload */
/* @var $type string */

?>
<div class="panel-heading">
    <h3 class="panel-title">
        <?= $persons->extraData['name'] ?>
        <span style="opacity: 0.5;">
            <?= count($persons->data) ?>
        </span>
    </h3>
    <?php if ($persons->extraData['type'] == 'followers' && !empty($persons->data)): ?>
        <?= Search::widget([
            'extraData' => $persons->extraData,
            'query' => $persons->getSearch(),
            'data' => $persons->data,
            'type' => $persons->type
        ]) ?>
    <?php endif; ?>
</div>
<div class="panel-body">
    <?php if (!empty($persons->data)): ?>
        <ul class="list-group list-group-dividered list-group-full h-300 scrollable is-enabled scrollable-vertical"
            data-plugin="scrollable" style="position: relative;">
            <div data-role="container" class="scrollable-container" style="height: 300px; width: 602px;">
                <div data-role="content" class="scrollable-content" style="width: 585px;">
                    <?php foreach ($persons->data as $personData): ?>
                        <?php /** @var \frontend\models\Person $person */
                        $person = $personData->person; ?>
                        <li class="list-group-item">
                            <div class="media">
                                <div class="media-left">
                                    <?= Html::a(Html::img($person->imageShow) . '<i></i>',
                                        ['/person/profile', 'id' => $person->id],
                                        ['class' => 'avatar avatar-online']) ?>
                                </div>
                                <div class="media-body">
                                    <div>
                                        <span><?= $person->full_name ?></span>
                                    </div>
                                    <small>@heavybutterfly920</small>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="scrollable-bar scrollable-bar-vertical scrollable-bar-hide" draggable="false">
                <div class="scrollable-bar-handle" style="height: 156.15px; transform: translate3d(0px, 0px, 0px);"></div>
            </div>
        </ul>
    <?php endif; ?>
</div>
