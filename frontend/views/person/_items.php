<?php

/* @var $persons \frontend\models\AjaxReload */

use frontend\models\Person;
use frontend\widgets\Pagination;
use frontend\widgets\Search;
use yii\helpers\Html;

?>
<br>
<?= Search::widget([
    'extraData' => $persons->extraData,
    'query' => $persons->getSearch(),
    'data' => $persons->data,
    'type' => $persons->type
]) ?>

<br>

<?php if (!empty($persons->data)): ?>
    <ul class="list-group">
        <?php /** @var \frontend\models\Person $person */
        foreach ($persons->data as $person): ?>
            <li class="list-group-item">
                <div class="media">
                    <div class="media-left">
                        <?= Html::a("<div class=\"avatar ". ($person->is_online ?
                                'avatar-online' : 'avatar-away') . " \">".
                            Html::img($person->imageShow,
                                ['alt' => '...']) .
                            "<i></i>".
                            "</div>",
                            ['/person/profile', 'id' => $person->id]) ?>
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
                        <div>
                            <a class="text-action" href="javascript:void(0)">
                                <i class="icon icon-color wb-envelope" aria-hidden="true"></i>
                            </a>
                            <a class="text-action" href="javascript:void(0)">
                                <i class="icon icon-color wb-mobile" aria-hidden="true"></i>
                            </a>
                            <a class="text-action" href="javascript:void(0)">
                                <i class="icon icon-color bd-twitter" aria-hidden="true"></i>
                            </a>
                            <a class="text-action" href="javascript:void(0)">
                                <i class="icon icon-color bd-facebook" aria-hidden="true"></i>
                            </a>
                            <a class="text-action" href="javascript:void(0)">
                                <i class="icon icon-color bd-dribbble" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                    <?php if ($person->relation == Person::RELATION_FOLLOWING): ?>
                        <div class="media-right p-t-10">
                            <?= Html::a('unfollow', ['/person/un-follow', 'id' => $person->id],
                                ['class' => 'btn btn-outline btn-default btn-sm']) ?>
                        </div>
                    <?php elseif ($person->relation != Person::RELATION_SELF): ?>
                        <div class="media-right p-t-10">
                            <?= Html::a('follow', ['/person/follow', 'id' => $person->id],
                                ['class' => 'btn btn-outline btn-primary btn-sm']) ?>
                        </div>
                    <?php endif; ?>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>

    <?= Pagination::widget($persons->pagination) ?>

<?php endif; ?>