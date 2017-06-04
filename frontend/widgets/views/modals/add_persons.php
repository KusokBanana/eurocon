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

$id = $type . '_' . $data['type'];

switch($data['type']) {
    case 'admins':
        $title = 'Add person to your team';
        $attribute = 'admins';
        break;
    case 'participants':
        $title = 'Chose person for cooperation';
        $attribute = 'participants';
        break;
}

?>
<style>
    span.select2-container.select2-container--krajee.select2-container--open {
        z-index: 10000;
    }
</style>

<div class="modal fade" id="<?= $id ?>" aria-labelledby="examplePositionCenter"
     role="dialog" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-center">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title"><?= $title ?></h4>
            </div>
            <div class="modal-body m-b-40">
                <?php $form = ActiveForm::begin([
                    'id' => $id . '_form',
                    'successCssClass' => '',
                    'action' => Url::to(['update-persons', 'id' => $model->id]),

                ]); ?>

                <?= $form->field($model, $attribute, ['template' => $templateInput])
                    ->widget(Select2::classname(),
                        [
                            'data' => $data['subscribers'],
                            'options' => [
                                'multiple' => true,
                                'placeholder' => 'Search Participants..'
                            ],
                            'class' => 'form-control',
                            'maintainOrder' => true,
                            'pluginOptions' => [
                                'tokenSeparators' => [',', ' '],
                                'maximumInputLength' => 10,
                                'allowClear' => true
                            ],
                        ])->label(false); ?>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="$('#<?= $id . '_form' ?>').submit();">
                    Save changes
                </button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->
