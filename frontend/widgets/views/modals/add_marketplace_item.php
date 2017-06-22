<?php
use frontend\models\Community;
use frontend\models\MarketplaceItem;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $model \yii\db\ActiveRecord */
/* @var $data array */
/* @var $type string */

$templateInput = '<div class="row"><div class="col-md-12 col-xs-12">{input}</div></div>';
$id = \yii\helpers\ArrayHelper::getValue($data, 'id');
?>


<div class="modal fade" id="<?= $type ?>" aria-hidden="true" aria-labelledby="examplePositionCenter"
     role="dialog" tabindex="-1">
    <div class="modal-dialog modal-center">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Add new Product</h4>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin([
                    //                                'enableAjaxValidation' => true,
                    'id' => $type . '_form',
                    'successCssClass' => '',
                    'action' => Url::to(['/company/create-marketplace-item', 'id' => $id]),
                    'options' => ['enctype' => 'multipart/form-data', 'class' => 'form-horizontal'],

                ]); ?>
                <!-- Example Basic -->
                    <?= $form->field($model, 'name', ['template' => $templateInput])
                        ->textInput([
                            'class' => 'form-control',
                            'placeholder' => 'BestWood',
                        ])
                        ->label(null); ?>
                    <?= $form->field($model, 'description', [
                        'template' => $templateInput
                    ])->textarea(
                        [
                            'class' => 'form-control',
                            'placeholder' => 'Describe your offer',
                            'rows' => '5',
                        ])->label(null, [
                        'class' => 'col-xs-12 col-xl-12 col-md-3 form-control-label'
                    ]) ?>
                    <?= $form->field($model, 'item_type_id', ['template' => $templateInput])
                        ->radioList(
                            [
                                MarketplaceItem::ITEM_TYPE_OFFER => 'Offer',
                                MarketplaceItem::ITEM_TYPE_REQUEST => 'Request'
                            ],
                            ['class' => 'col-md-9 col-xs-9 col-xl-9 col-lg-9 p-l-0',
                                'style' => 'text-align:left;',
                                'item' => function($index, $label, $name, $checked, $value) {
                                    $return = '<div class="radio-custom radio-default radio-inline m-l-10">';
                                    $return .= '<input type="radio" ' .
                                        ' name="' . $name . '" id="'.$name.'-'.$index.'" '.
                                        'value="' . $value . '">';
                                    $return .= '<label for="'.$name.'-'.$index.'" '.'">'.$label.'</label>';
                                    $return .= '</div>';

                                    return $return;
                                }])
                        ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']); ?>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" onclick="$('#<?= $type ?>_form').submit();" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>