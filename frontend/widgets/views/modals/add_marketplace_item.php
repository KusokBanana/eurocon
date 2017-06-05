<?php
use frontend\models\Community;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $model \yii\db\ActiveRecord */
/* @var $data array */
/* @var $type string */

$templateInput = '<div class="col-md-12 col-xs-12">{input}</div>';

?>


<div class="modal fade" id="<?= $type ?>" aria-hidden="true" aria-labelledby="examplePositionCenter"
     role="dialog" tabindex="-1">
    <div class="modal-dialog modal-center">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Let's do this</h4>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin([
                    //                                'enableAjaxValidation' => true,
                    'id' => $type . '_form',
                    'successCssClass' => '',
                    'action' => Url::to(['update', 'id' => $model->id]),
                    'options' => ['enctype' => 'multipart/form-data', 'class' => 'form-horizontal'],

                ]); ?>
                <!-- Example Basic -->
                        <?= $form->field($model, 'item_type_id', ['template' => $templateInput])
                            ->radioList(['Offers', 'Requests'],
                                ['class' => '',
                                    'item' => function($index, $label, $name, $checked, $value) {
                                        $checked = $checked ? ' checked ' : '';
                                        $return = '<div class="radio-custom radio-primary m-l-30 col-xs-12 col-xl-2 form-group">';
                                        $return .= '<input type="radio" '. $checked .
                                            ' name="' . $name . '" id="'.$name.'-'.$index.'" '.
                                            'value="' . $value . '">';
                                        $return .= '<label for="'.$name.'-'.$index.'" '.'">'.$label.'</label>';
                                        $return .= '</div>';

                                        return $return;
                                    }])
                            ->label(null); ?>
                        <div class="radio-custom radio-primary m-l-30 col-xs-12 col-xl-2 form-group">
                            <input type="radio" id="inputRadiosUnchecked" name="inputRadios">
                            <label for="inputRadiosUnchecked">Offers</label>
                        </div>
                        <div class="radio-custom radio-primary m-l-30 col-xs-12 col-xl-2 form-group">
                            <input type="radio" id="inputRadiosUnchecked" name="inputRadios">
                            <label for="inputRadiosUnchecked">Requests</label>
                        </div>
                    <div class="row">
                        <div class="col-xs-12 col-xl-4 form-group">
                            <input type="text" class="form-control" name="Offer Name" placeholder="BestWood">
                        </div>
                        <div class="col-xl-12 col-xs-12">
                            <textarea class="form-control" rows="5" placeholder="Describe your offer"></textarea>
                        </div>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>