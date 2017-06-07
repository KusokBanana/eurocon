<?php

/* @var $communities \frontend\models\AjaxReload */

use frontend\widgets\Pagination;
use frontend\widgets\Search;
use yii\helpers\Html;

?>

<br>
<?= Search::widget([
    'extraData' => $communities->extraData,
    'query' => $communities->getSearch(),
    'data' => $communities->data,
    'type' => $communities->type
]) ?>

<?php if (isset($communities->extraData['isWithBtn']) && $communities->extraData['isWithBtn']): ?>
    <div class="panel">
        <div class="panel-body container-fluid text-xs-center">
            <?= Html::a('<span><i class="icon fa-group" aria-hidden="true"></i>Create a community</span>',
                ['/community/create'],
                ['class' => 'btn btn-primary btn-animate btn-animate-side']) ?>
        </div>
    </div>
<?php endif; ?>

<?php if (!empty($communities->data)): ?>
    <ul class="list-group">
        <?php foreach ($communities->data as $community): ?>
            <li class="list-group-item">
                <div class="media">
                    <div class="media-left">
                        <div class="avatar avatar-online">
                            <?= Html::a(Html::img($community->imageShow, [
                                    'alt' => '...'
                            ]), ['/community/view', 'id' => $community->id]) ?>
                        </div>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading"><?= $community->name ?></h4>
                        <p>
                            <i class="icon icon-color wb-map" aria-hidden="true"></i>
                        </p>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>

    <?= Pagination::widget($communities->pagination) ?>

<?php endif; ?>

