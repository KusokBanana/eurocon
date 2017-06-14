<?php
/* @var $type string */
/* @var $extraData array */
/* @var $query string */
/* @var $isEmpty bool */
/* @var $wrapSelector string */

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;

?>
<div class="input-search <?= ArrayHelper::getValue($extraData, 'search-wrapper-class', '') ?>">
    <i class="input-search-icon wb-search" aria-hidden="true"></i>
    <?= Html::textInput('ajaxReloadSearch', $query, [
        'class' => 'form-control search-ajax-field',
        'data-href' => Url::to(['ajax-reload', 'page' => 1, 'type' => $type]),
        'data-addition' => Json::encode($extraData),
        'placeholder' => ArrayHelper::getValue($extraData, 'placeholder', 'Search'),
        'data-wrap' => $wrapSelector
    ]) ?>
    <?= Html::button('', [
        'class' => 'input-search-close icon wb-close',
        'aria-label' => 'Close',
    ]) ?>
    </div>
<?php if ($isEmpty && $query): ?>
    <br>
    <p>По запросу ничего не найдено.</p>
<?php endif; ?>