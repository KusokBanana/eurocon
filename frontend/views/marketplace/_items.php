<?php

use frontend\models\MarketplaceItem;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use frontend\widgets\Pagination;
use yii\helpers\Json;
use yii\helpers\Url;
use frontend\widgets\Search;

/* @var $items array */
/* @var $additionData array */
// TODO решить проблему с тем, что после того как сделали ajax подгрузку - скрипт Media больше не фурычит
$additionData['search'] = ArrayHelper::getValue($additionData, 'search', null);
$filter = $additionData['filter'] = $items['filter'];
$additionData['wrapSelector'] = '#marketplace';
?>

<div class="page-header">
    <div class="panel">
        <?= Search::widget([
            'query' => $additionData['search'],
            'data' => $items['data'],
            'type' => $items['type'],
            'additionData' => ArrayHelper::merge($additionData, [
                'placeholder' => 'Find post...',
                'search-wrapper-class' => 'input-search input-search-dark'
            ]),
            'wrapSelector' => $additionData['wrapSelector']
        ]) ?>

        <div class="panel-body container-fluid">
            <div class="row row-lg">

                <?= Html::beginForm(['ajax-reload', 'type' => $items['type'], 'page' => 1], 'post',
                    [
                        'class' => 'ajax-reload-filter',
                        'data-wrapSelector' => $additionData['wrapSelector'],
                        'data-addition' => Json::encode($additionData)
                    ]) ?>
                    <div class="col-md-3 col-xl-3 col-xs-12 ">
                        <div class="form-group row">
                            <div class="radio-custom radio-primary m-l-30 col-xs-12 col-xl-2 form-group m-r-25">
                                <?= Html::radio('item_type_id',
                                    ArrayHelper::getValue($filter, 'item_type_id') == MarketplaceItem::ITEM_TYPE_OFFER,
                                    ['value' => MarketplaceItem::ITEM_TYPE_OFFER]) ?>
                                <?= Html::label('Offers', 'item_type_id') ?>
                            </div>
                            <div class="radio-custom radio-primary m-l-30 col-xs-12 col-xl-2 form-group m-l-25">
                                <?= Html::radio('item_type_id',
                                    ArrayHelper::getValue($filter, 'item_type_id') == MarketplaceItem::ITEM_TYPE_REQUEST,
                                    ['value' => MarketplaceItem::ITEM_TYPE_REQUEST]) ?>
                                <?= Html::label('Requests', 'item_type_id') ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-4 col-xs-12">
                        <div class="form-group row">
                            <?= Html::label('Type', 'type_id', ['class' => 'form-control-label col-xs-12 col-md-3']) ?>
                            <div class="col-md-9 col-xs-12">
                                <?= Html::dropDownList('type_id',
                                    ArrayHelper::getValue($filter, 'type_id'),
                                    MarketplaceItem::$types,
                                    ['class' => 'form-control']) ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <?= Html::label('Status', 'status_id', ['class' => 'form-control-label col-xs-12 col-md-3']) ?>
                            <div class="col-md-9 col-xs-12">
                                <?= Html::dropDownList('status_id',
                                    ArrayHelper::getValue($filter, 'status_id'),
                                    MarketplaceItem::$statuses,
                                    ['class' => 'form-control']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-4 col-xs-12">
                        <div class="form-group row">
                            <?= Html::label('Budget', 'budget_id', ['class' => 'form-control-label col-xs-12 col-md-3']) ?>
                            <div class="col-md-9 col-xs-12">
                                <?= Html::dropDownList('budget_id',
                                    ArrayHelper::getValue($filter, 'budget_id'),
                                    MarketplaceItem::$budgets,
                                    ['class' => 'form-control']) ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <?= Html::label('Category', 'category_id', ['class' => 'form-control-label col-xs-12 col-md-3']) ?>
                            <div class="col-md-9 col-xs-12">
                                <?= Html::dropDownList('category_id',
                                    ArrayHelper::getValue($filter, 'category_id'),
                                    MarketplaceItem::$categories,
                                    ['class' => 'form-control']) ?>
                            </div>
                        </div>
                    </div>
                <?= Html::endForm() ?>
            </div>
        </div>
    </div>
</div>
<!-- Media Content -->
<div id="mediaContent" class="page-content page-content-table" data-plugin="selectable">
    <!-- Actions -->
    <div class="page-content-actions">
        <div class="pull-xs-right">
            <div class="btn-group media-arrangement" role="group">
                <button class="btn btn-outline btn-default active" id="arrangement-grid" type="button"><i class="icon wb-grid-4" aria-hidden="true"></i></button>
                <button class="btn btn-outline btn-default" id="arrangement-list" type="button"><i class="icon wb-list" aria-hidden="true"></i></button>
            </div>
        </div>
    </div>
    <!-- Media -->
    <?php if (!empty($items['data'])): ?>

    <div class="media-list is-grid p-b-50" data-plugin="animateList" data-animate="fade"
         data-child="li">
        <ul class="blocks blocks-100 blocks-xxl-4 blocks-xl-3 blocks-lg-3 blocks-md-2 blocks-sm-2"
            data-plugin="animateList" data-child=">li">
            <?php /** @var MarketplaceItem $item */
            foreach ($items['data'] as $item): ?>
                <li>
                <div class="media-item">
                    <a href="<?= Url::to(['view', 'id' => $item->id]) ?>" class="no-underline">
                        <div class="image-wrap">
                            <?= Html::img($item->imageShow, ['class' => 'image img-rounded']) ?>
                        </div>
                        <div class="info-wrap">
                            <div class="title"><?= $item->name ?></div>
                            <div class="time"><?= $item->description ?></div>
                        </div>
                    </a>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>

    </div>

    <div class="text-center">
        <?php $items['data'] = $additionData; ?>
        <?= Pagination::widget($items); ?>
    </div>

    <?php endif; ?>
</div>