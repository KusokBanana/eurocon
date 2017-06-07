<?php

/* @var $companies \frontend\models\AjaxReload */

use frontend\widgets\Pagination;
use frontend\widgets\Search;
use yii\helpers\Html;

?>

<br>
<?= Search::widget([
    'extraData' => $companies->extraData,
    'query' => $companies->getSearch(),
    'data' => $companies->data,
    'type' => $companies->type
]) ?>

<?php if (isset($companies->extraData['isWithCreateBtn']) && $companies->extraData['isWithCreateBtn']): ?>
    <div class="panel">
        <div class="panel-body container-fluid text-xs-center">
            <?= Html::a('<span><i class="icon wb-home" aria-hidden="true"></i>Create a company</span>',
                ['/company/create'],
                ['class' => 'btn btn-primary btn-animate btn-animate-side']) ?>
        </div>
    </div>
<?php endif; ?>

<?php if (!empty($companies->data)): ?>
    <ul class="list-group">
        <?php foreach ($companies->data as $company): ?>
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

    <?= Pagination::widget($companies->pagination) ?>

<?php endif; ?>
