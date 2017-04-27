<?php

/* @var $communities array */
/* @var $communities['data'] \frontend\models\Company array */
/* @var $additionData array*/

use frontend\widgets\Pagination;
use frontend\widgets\Search;
use yii\helpers\Html;

$additionData['search'] = isset($additionData['search']) ? $additionData['search'] : null;
?>

<br>
<?= Search::widget([
    'additionData' => $additionData,
    'query' => $additionData['search'],
    'data' => $communities['data'],
    'type' => $communities['type']
]) ?>

<?php if (!empty($communities)): ?>
    <ul class="list-group">
        <?php foreach ($communities['data'] as $community): ?>
            <li class="list-group-item">
                <div class="media">
                    <div class="media-left">
                        <div class="avatar avatar-online">
                            <?= Html::a(Html::img($community->image, [
                                    'alt' => '...'
                            ]), ['/company/view', 'id' => $community->id]) ?>
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

    <?php $communities['data'] = $additionData ?>
    <?= Pagination::widget($communities) ?>

<?php endif; ?>

