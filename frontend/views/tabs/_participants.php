<?php
/* @var $participants \frontend\models\AjaxReload */

use frontend\widgets\Pagination;
use frontend\widgets\Search;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;

?>

<?php if (isset($participants->extraData['isWithBtn']) && $participants->extraData['isWithBtn']): ?>
    <?= Html::button('<i class="icon wb-plus"></i> Invite Participant',
        [
            'class' => 'btn btn-outline btn-primary m-t-15 m-b-15',
            'data-target' => '#add_persons_' . $participants->type,
            'data-toggle' => 'modal',

        ]) ?>
<?php endif; ?>

<br>

<?= Search::widget([
    'extraData' => $participants->extraData,
    'query' => $participants->getSearch(),
    'data' => $participants->data,
    'type' => $participants->type
]) ?>

<?php if (!empty($participants->data)): ?>
    <ul class="list-group">
        <?php foreach ($participants->data as $participant): ?>
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
                            <?= $participant->location['name'] ?>
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

    <?= Pagination::widget($participants->pagination); ?>

<?php endif; ?>