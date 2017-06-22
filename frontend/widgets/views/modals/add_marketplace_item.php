<?php
use frontend\models\Community;
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
                <?php ActiveForm::end(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" onclick="$('#<?= $type ?>_form').submit();" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>