<?php
/* @var $type string */
/* @var $additionData array */
/* @var $query string */
/* @var $isEmpty bool */

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;

?>
<div class="input-search input-search-dark">
    <i class="input-search-icon wb-search" aria-hidden="true"></i>
    <?= Html::textInput('search_projects', $query, [
        'class' => 'form-control search-ajax-field',
        'data-href' => Url::to(['ajax-reload', 'page' => 1, 'type' => $type]),
        'data-addition' => Json::encode($additionData),
        'placeholder' => ArrayHelper::getValue($additionData, 'placeholder', 'Search'),
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