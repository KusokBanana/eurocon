<?php


/* @var $type string */
use frontend\models\Community;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $model \yii\db\ActiveRecord */
/* @var $data array */

$templateInput = '<div class="row">{label}<div class="col-md-9 col-xs-9 col-xl-9 col-lg-9">{input}'.
    '<small class="text-danger">{error}</small></div></div>';
?>
<style>
    span.select2-container.select2-container--krajee.select2-container--open {
        z-index: 10000;
    }
</style>
<div class="modal fade" id="<?= $type ?>" aria-hidden="true"
     aria-labelledby="exampleModalTabs" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="exampleModalTabs">Setting</h4>
            </div>
            <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab" href="#exampleLine1" aria-controls="exampleLine1" role="tab">Community Profile</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#exampleLine3" aria-controls="exampleLine3" role="tab">Notifications</a></li>
            </ul>
            <div class="modal-body">

                <?php $form = ActiveForm::begin([
                    //                                'enableAjaxValidation' => true,
                    'id' => $type . '_form',
                    'successCssClass' => '',
                    'action' => Url::to(['update', 'id' => $model->id]),
                    'options' => ['enctype' => 'multipart/form-data']
                ]); ?>

                <div class="tab-content">
                    <div class="tab-pane active" id="exampleLine1" role="tabpanel">
                        <div class="col-md-12 col-lg-12 col-xs-12">
                            <!-- Example Horizontal Form -->
                            <div class="example-wrap">
                                <div class="example">

                                        <?= $form->field($model, 'name', [
                                            'template' => $templateInput
                                        ])->textInput(
                                            [
                                                'class' => 'form-control',
                                                'placeholder' => 'The best wood tables',
                                            ])->label(null, [
                                            'class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label'
                                        ]) ?>

                                        <?= $form->field($model, 'tagValues', ['template' => $templateInput])
                                            ->textInput([
                                                'class' => 'form-control',
                                                'data-plugin' => 'tokenfield',
                                                'data-delay' => 100,
                                                'value' => join(',', ArrayHelper::getColumn($model->ownTags, 'tag')),
                                                'data-delimiter' => [',', ' '],
                                            ])
                                            ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>

                                        <?php $templateFileInput =
                                            '<div class="form-group row">{label}<div class="col-md-9 col-xs-9 col-xl-9 col-lg-9">'.
                                            '<div class="input-group input-group-file" data-plugin="inputGroupFile">'.
                                            Html::textInput('', $model->image, ['class' => 'form-control', 'readonly' => '']).
                                            '<span class="input-group-btn">'.
                                            '<span class="btn btn-outline btn-file">'.
                                            '<i class="icon wb-upload" aria-hidden="true"></i>{input}</span></span></div>'.
                                            '<small class="text-danger">{error}</small></div></div>'; ?>

                                        <?= $form->field($model, 'imageFile', ['template' => $templateFileInput])
                                            ->fileInput()
                                            ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>

                                        <?php $templateFileInput =
                                            '<div class="form-group row">{label}<div class="col-md-9 col-xs-9 col-xl-9 col-lg-9">'.
                                            '<div class="input-group input-group-file" data-plugin="inputGroupFile">'.
                                            Html::textInput('', $model->background, ['class' => 'form-control', 'readonly' => '']).
                                            '<span class="input-group-btn">'.
                                            '<span class="btn btn-outline btn-file">'.
                                            '<i class="icon wb-upload" aria-hidden="true"></i>{input}</span></span></div>'.
                                            '<small class="text-danger">{error}</small></div></div>'; ?>

                                        <?= $form->field($model, 'backgroundFile', ['template' => $templateFileInput])
                                            ->fileInput()
                                            ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>

                                </div>
                            </div>
                            <!-- End Example Horizontal Form -->
                        </div>
                    </div>
                    <div class="tab-pane" id="exampleLine3" role="tabpanel">
                        <div class="col-md-12 col-lg-12 col-xs-12">
                            <!-- Example Horizontal Form -->
                            <div class="example-wrap">
                                <div class="example">
                                    <?= $form->field($model, 'post_ability_id', ['template' => $templateInput])
                                        ->dropDownList(Community::$post_abilities, ['class' => 'form-control'])
                                        ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>

                                    <?= $form->field($model, 'acceptance_id', ['template' => $templateInput])
                                        ->dropDownList(Community::$acceptance, ['class' => 'form-control'])
                                        ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>
                                </div>
                            </div>
                            <!-- End Example Horizontal Form -->
                        </div>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="$('#<?= $type ?>_form').submit();">Save changes</button>
            </div>
        </div>
    </div>
</div>
