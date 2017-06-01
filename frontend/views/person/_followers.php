<?php
/* @var $participants array */
/* @var $additionData array*/

use frontend\models\books\BookFollowers;
use frontend\models\Person;
use frontend\widgets\Pagination;
use frontend\widgets\Search;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;

$additionData['search'] = isset($additionData['search']) ? $additionData['search'] : null;
$additionData['type'] = isset($additionData['type']) && $additionData['type'] ?
    $additionData['type'] : BookFollowers::TYPE_ALL;
?>

<br>
<?= Search::widget([
    'additionData' => $additionData,
    'query' => $additionData['search'],
    'data' => $participants['data'],
    'type' => $participants['type']
]) ?>

<div class="panel filter-tab-info"
     data-href="<?= Url::to(['ajax-reload', 'page' => 1, 'type' => $participants['type']]) ?>"
     data-addition='<?= Json::encode($additionData) ?>'>
    <div class="panel-body container-fluid">
        <div class="row">
            <div class="col-md-3 col-xl-3 col-xs-6">
                <div class="radio-custom radio-primary m-l-30" style="display: inline-block; padding-left: 20px;">
                    <?= Html::radio('type', $additionData['type'] == BookFollowers::TYPE_FOLLOWER, [
                        'id' => 'type-radio-1',
                        'value' => BookFollowers::TYPE_FOLLOWER,
                        'class' => 'filter-ajax-tabs'
                    ]) ?>
                    <?= Html::label('Followers', 'type-radio-1') ?>
                </div>
            </div>
            <div class="col-md-3 col-xl-3 col-xs-6">
                <div class="radio-custom radio-primary m-l-30">
                    <?= Html::radio('type', $additionData['type'] == BookFollowers::TYPE_FOLLOWING, [
                        'id' => 'type-radio-2',
                        'value' => BookFollowers::TYPE_FOLLOWING,
                        'class' => 'filter-ajax-tabs'
                    ]) ?>
                    <?= Html::label('Following', 'type-radio-2') ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (!empty($participants['data'])): ?>
    <ul class="list-group">
        <?php /** @var Person $participant */
        foreach ($participants['data'] as $participant): ?>
            <li class="list-group-item">
                <div class="media">
                    <div class="media-left">
                        <?= Html::a("<div class=\"avatar ". ($participant->is_online ?
                            'avatar-online' : 'avatar-away') . " \">".
                             Html::img($participant->imageShow,
                                ['alt' => '...']) .
                                    "<i></i>".
                                    "</div>",
                            ['/person/profile', 'id' => $participant->id]) ?>

                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">
                            <?= $participant->full_name ?>
                            <small>Last Access: <?= $participant->last_access ?></small>
                        </h4>
                        <p>
                            <i class="icon icon-color wb-map" aria-hidden="true"></i>
                            Street 4190 W Lone Mountain Rd
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
                    <?php if ($participant->relation == Person::RELATION_FOLLOWING): ?>
                        <div class="media-right p-t-10">
                            <?= Html::a('unfollow', ['/person/un-follow', 'id' => $participant->id],
                                ['class' => 'btn btn-outline btn-default btn-sm']) ?>
                        </div>
                    <?php elseif ($participant->relation != Person::RELATION_SELF): ?>
                        <div class="media-right p-t-10">
                            <?= Html::a('follow', ['/person/follow', 'id' => $participant->id],
                                ['class' => 'btn btn-outline btn-primary btn-sm']) ?>
                        </div>
                    <?php endif; ?>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>

    <?php $participants['data'] = $additionData; ?>

    <?= Pagination::widget($participants); ?>

<?php endif; ?>