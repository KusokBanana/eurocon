<?php

/* @var $companies array */
/* @var $companies['data'] \frontend\models\Company array */
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
    'data' => $companies['data'],
    'type' => $companies['type']
]) ?>

<?php if (!empty($companies)): ?>
    <ul class="list-group">
        <?php foreach ($companies['data'] as $company): ?>
            <li class="list-group-item">
                <div class="media">
                    <div class="media-left">
                        <?= Html::a('<div class="avatar avatar-online">'.
                            Html::img($company->imageShow, [
                                'alt' => '...'
                            ]).'</div>',
                            ['/company/view', 'id' => $company->id]) ?>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">
                            <?= $company->name ?>
                        </h4>
                        <p><?= $company->description ?></p>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>

    <?php $companies['data'] = $additionData ?>
    <?= Pagination::widget($companies) ?>

<?php endif; ?>
