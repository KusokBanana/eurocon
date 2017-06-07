<?php

use frontend\models\MarketplaceItem;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use frontend\widgets\Pagination;
use yii\helpers\Json;
use yii\helpers\Url;
use frontend\widgets\Search;

/* @var $items \frontend\models\AjaxReload */

?>
<br>
<?= Search::widget([
    'extraData' => $items->extraData,
    'query' => ArrayHelper::getValue($items->extraData, 'search', ''),
    'data' => $items->data,
    'type' => $items->type
]) ?>

<div class="panel">

    <div class="panel-body container-fluid">
        <div class="row row-lg">

            <?= Html::beginForm(['ajax-reload', 'type' => $items->type, 'page' => $items->page], 'post',
                [
                    'class' => 'ajax-reload-filter',
                    'data-addition' => Json::encode($items->extraData)
                ]) ?>

                <div class="col-md-4 col-xl-3 col-xs-12">
                    <!-- Example Basic -->
                    <div class="radio-custom radio-primary m-l-30" style="display: inline-block; padding-left: 20px;">
                        <?= Html::radio('item_type_id',
                            $items->getFilterVal('item_type_id') == MarketplaceItem::ITEM_TYPE_OFFER,
                            ['value' => MarketplaceItem::ITEM_TYPE_OFFER]) ?>
                        <?= Html::label('Offers', 'item_type_id') ?>
                    </div>
                    <div class="radio-custom radio-primary m-l-30">
                        <?= Html::radio('item_type_id',
                            $items->getFilterVal('item_type_id') == MarketplaceItem::ITEM_TYPE_REQUEST,
                            ['value' => MarketplaceItem::ITEM_TYPE_REQUEST]) ?>
                        <?= Html::label('Requests', 'item_type_id') ?>
                    </div>
                </div>
                <div class="col-md-4 col-xl-4 col-xs-12">
                    <!-- Example Colors -->
                    <div class="form-group row">
                        <?= Html::label('Type', 'type_id', ['class' => 'form-control-label col-xs-12 col-md-3']) ?>
                        <div class="col-md-9 col-xs-12">
                            <?= Html::dropDownList('type_id',
                                $items->getFilterVal('type_id'),
                                MarketplaceItem::$types,
                                ['class' => 'form-control']) ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <?= Html::label('Budget', 'budget_id', ['class' => 'form-control-label col-xs-12 col-md-3']) ?>
                        <div class="col-md-9 col-xs-12">
                            <?= Html::dropDownList('budget_id',
                                $items->getFilterVal('budget_id'),
                                MarketplaceItem::$budgets,
                                ['class' => 'form-control']) ?>
                        </div>
                    </div>

                </div>

            <?= Html::endForm() ?>

            <div class="col-md-4 col-xl-3 col-xs-12 p-t-30">
                <?= Html::button('<i class="icon wb-plus" aria-hidden="true"></i> Add offers or request',
                    [
                        'class' => 'btn btn-outline btn-primary',
                        'data-target' => '#add_marketplace_item',
                        'data-toggle' => 'modal',

                    ]) ?>
            </div>

        </div>
    </div>
</div>

<?php if (!empty($items->data)): ?>
    <ul class="list-group">
        <?php /** @var MarketplaceItem $item */
        foreach ($items->data as $item): ?>
            <?php $item = $item->item; ?>
            <li class="list-group-item">
                <div class="media media-lg">
                    <div class="media-body">
                        <div class="profile-brief">
                            <div class="media">
                                <?= Html::a(
                                        Html::img($item->imageShow, ['class' => 'media-object']),
                                    ['/marketplace/view', 'id' => $item->id],
                                    ['class' => 'media-left']) ?>
                                <div class="media-body p-l-20 p-r-15">
                                    <h4 class="media-heading"><?= $item->name ?></h4>
                                    <p><?= $item->description ?></p>
                                </div>
                                <div class="media-left media-middle"
                                     style="border-left: 1px solid rgb(213,228,241); padding: 15px; width: 20%;">
                                    <span><?= date('d.m.Y', strtotime($item->date)) ?></span>
                                    <br>
                                    <span>Jo Smith</span>
                                    <hr>
                                    <span><mark style="background-color: #89BCEB;">On request</mark></span> <!-- TODO add here money  -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>

        <?php endforeach; ?>
    </ul>

    <?= Pagination::widget($items->pagination); ?>

<?php endif; ?>


