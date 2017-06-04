<?php
use frontend\assets\AppAsset;
use frontend\models\Person;
use kartik\select2\Select2;
use voime\GoogleMaps\MapInput;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;


/* @var $type string */
/* @var $model \frontend\models\Post */
/* @var $data array */
/* @var $this \yii\web\View */

$templateInput = '<div class="row">{label}<div class="col-md-9 col-xs-9 col-xl-9 col-lg-9">{input}'.
    '<small class="text-danger">{error}</small></div></div>';
?>

<div class="modal fade" id="<?= $type ?>" aria-hidden="true"
     aria-labelledby="exampleModalTabs" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="exampleModalTabs">Add new Post</h4>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin([
                    //                                'enableAjaxValidation' => true,
                    'id' => $type . '_form',
                    'successCssClass' => '',
                    'action' => Url::to(['forum', 'post_id' => 0, 'action' => 'create']),
                    'options' => ['enctype' => 'multipart/form-data', 'class' => 'form-horizontal'],

                ]); ?>
                    <div class="col-md-12 col-lg-12 col-xs-12">
                        <!-- Example Horizontal Form -->
                        <div class="example-wrap">
                            <div class="example">

                                <?= $form->field($model, 'title', ['template' => $templateInput])
                                    ->textInput(['class' => 'form-control',
                                        'autocomplete' => 'off'])
                                    ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>

                                <?= $form->field($model, 'text', ['template' => $templateInput])
                                    ->textarea(['class' => 'form-control', 'rows' => 4,
                                        'autocomplete' => 'off'])
                                    ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>

                                <?= $form->field($model, 'field_id')
                                    ->hiddenInput(['value' => $data['for_model']->id])
                                    ->label(false); ?>

                                <?php $templateFileInput =
                                    '<div class="row">{label}<div class="col-md-9 col-xs-9 col-xl-9 col-lg-9">'.
                                    '<div class="input-group input-group-file" data-plugin="inputGroupFile">'.
                                    Html::textInput('', false, ['class' => 'form-control', 'readonly' => '']).
                                    '<span class="input-group-btn">'.
                                    '<span class="btn btn-outline btn-file">'.
                                    '<i class="icon wb-upload" aria-hidden="true"></i>{input}</span></span></div>'.
                                    '<small class="text-danger">{error}</small></div></div>'; ?>

                                <?= $form->field($model, 'image_files[]', ['template' => $templateFileInput])
                                    ->fileInput(['multiple' => 'multiple', 'accept' => 'image/*'])
                                    ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>

                            </div>
                        </div>
                        <!-- End Example Horizontal Form -->
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" onclick="$('#<?= $type ?>_form').submit();" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>