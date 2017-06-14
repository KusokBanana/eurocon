<?php

/* @var $companies \frontend\models\AjaxReload */

use frontend\widgets\Pagination;
use frontend\widgets\Search;
use yii\helpers\Html;

?>

<?= Search::widget([
    'extraData' => $companies->extraData,
    'query' => $companies->getSearch(),
    'data' => $companies->data,
    'type' => $companies->type
]) ?>

<br>

<?php if (!empty($companies->data)): ?>
    <ul class="list-group">
        <?php foreach ($companies->data as $company): ?>
            <li class="list-group-item">
                <div class="media">
                    <div class="media-left">
                        <div class="avatar avatar-online">
                            <?= Html::a(Html::img($company->imageShow, [
                                'alt' => '...'
                            ]), ['/community/view', 'id' => $company->id]) ?>
                        </div>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading"><?= $company->name ?></h4>
                        <p>
                            <i class="icon icon-color wb-map" aria-hidden="true"></i>
                        </p>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>

    <?= Pagination::widget($companies->pagination) ?>

<?php endif; ?>
