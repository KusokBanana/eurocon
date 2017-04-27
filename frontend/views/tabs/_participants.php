<?php
/* @var $participants array */
/* @var $participants['data'] \frontend\models\Person array*/
/* @var $additionData array*/

use frontend\widgets\Pagination;
use frontend\widgets\Search;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;

$additionData['search'] = isset($additionData['search']) ? $additionData['search'] : null;
?>

<br>
<?= Search::widget([
    'additionData' => $additionData,
    'query' => $additionData['search'],
    'data' => $participants['data'],
    'type' => $participants['type']
]) ?>

<?php if (!empty($participants['data'])): ?>
    <ul class="list-group">
        <?php foreach ($participants['data'] as $participant): ?>
            <li class="list-group-item">
                <div class="media">
                    <div class="media-left">
                        <?= Html::a("<div class=\"avatar ". ($participant->is_online ?
                            'avatar-online' : 'avatar-away') . " \">".
                             Html::img($participant->image,
                                ['alt' => '...']) .
                                    "<i></i>".
                                    "</div>",
                            ['/site/index', 'id' => $participant->id]) ?>

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
                </div>
            </li>
        <?php endforeach; ?>
    </ul>

    <?php $participants['data'] = $additionData; ?>

    <?= Pagination::widget($participants); ?>

<?php endif; ?>