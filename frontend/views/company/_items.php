<?php

/* @var $companies \frontend\models\AjaxReload */

use frontend\widgets\Pagination;
use frontend\widgets\Search;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$isGuest = Yii::$app->user->isGuest;
?>
<div class="panel">
    <div class="panel-body">
        <?= Search::widget([
            'extraData' => $companies->extraData,
            'query' => $companies->getSearch(),
            'data' => $companies->data,
            'type' => $companies->type
        ]) ?>
    </div>
</div>
<div class="panel-bordered panel">
    <div class="panel-heading"><h3 class="panel-title"><?= $isGuest ? 'All' : 'My' ?> companies</h3></div>
    <div class="panel-body">

        <?php if (!empty($companies->data)): ?>
            <ul class="list-group m-b-0">
                <?php foreach ($companies->data as $key => $company): ?>

                    <?php
                    if (!$key && $company->search_type_id == 1 && !$isGuest){
                        echo "<p>You don't have companies for this search</p>";
                    }

                    $prevItemSearchId = 0;
                    if (isset($companies->data[$key-1]))
                        $prevItemSearchId = ArrayHelper::getValue($companies->data[$key-1], 'search_type_id');

                    if ($prevItemSearchId == 0 && $company['search_type_id'] == 1): ?>
            </ul>
        <?php if (!$isGuest): ?>
    </div>
</div>
<br>
<div class="panel panel-bordered">
    <div class="panel-heading"><h3 class="panel-title"><?= $isGuest ? 'All' : 'My' ?> Companies</h3></div>
    <div class="panel-body">
        <?php endif; ?>
        <ul class="list-group">
                    <?php endif; ?>
                    <li class="list-group-item">
                        <div class="media">
                            <div class="media-left">
                                <div class="avatar avatar-online">
                                    <?= Html::a(Html::img($company->imageShow, [
                                        'alt' => '...'
                                    ]), ['view', 'id' => $company->id]) ?>
                                </div>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading"><?= $company->name ?></h4>
<!--                                <p>-->
<!--                                    <i class="icon icon-color wb-map" aria-hidden="true"></i>-->
<!--                                </p>-->
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>

            <?= Pagination::widget($companies->pagination) ?>

        <?php elseif (!$companies->getSearch()): ?>
            <p>You don't have companies in the moment. <?= Html::a('Create company', ['create']) ?>
                or subscribe to one of the existing</p>
        <?php elseif ($companies->getSearch()): ?>
            <p>You don't have companies for this search</p>
        <?php endif; ?>
    </div>
</div>

