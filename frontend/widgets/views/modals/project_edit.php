<?php
use frontend\models\Project;
use kartik\select2\Select2;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->registerCssFile('@web/vendor/bootstrap-tokenfield/bootstrap-tokenfield.min.css');

/* @var $type string */
/* @var $model Project */
/* @var $data array */

$templateInput = '<div class="row">{label}<div class="col-md-9 col-xs-9 col-xl-9 col-lg-9">{input}'.
    '<small class="text-danger">{error}</small></div></div>';
?>
<style>
    span.select2-container.select2-container--krajee.select2-container--open {
        z-index: 10000;
    }
</style>
<div class="modal fade" id="<?= $type ?>" aria-labelledby="exampleModalTabs" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="exampleModalTabs">Setting</h4>
            </div>
            <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" data-toggle="tab" href="#exampleLine1"
                       aria-controls="exampleLine1" role="tab">Project Profile</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-toggle="tab" href="#exampleLine2" aria-controls="exampleLine2"
                       role="tab">Project Information</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-toggle="tab" href="#exampleLine3" aria-controls="exampleLine3"
                       role="tab">Common</a>
                </li>
            </ul>
            <div class="modal-body">

                <?php $form = ActiveForm::begin([
                //                                'enableAjaxValidation' => true,
                    'id' => $type . '_form',
                    'successCssClass' => '',
                    'action' => Url::to(['update', 'project_id' => $model->id]),
                    'options' => ['enctype' => 'multipart/form-data']
                ]); ?>
                <div class="tab-content">
                    <div class="tab-pane active" id="exampleLine1" role="tabpanel">
                        <div class="col-md-12 col-lg-12 col-xs-12">
                            <!-- Example Horizontal Form -->
                            <div class="example-wrap">
                                <div class="example">
                                    <?= $form->field($model, 'name', ['template' => $templateInput])
                                        ->textInput(['class' => 'form-control', 'placeholder' => 'Great project №1',
                                            'autocomplete' => 'off'])
                                        ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>

                                    <?= $form->field($model, 'owners', ['template' => $templateInput])
                                        ->widget(Select2::classname(),
                                            [
                                                'data' => $data['subscribers'],
                                                'options' => [
                                                    'multiple' => true,
                                                ],
                                                'class' => 'form-control',
                                                'maintainOrder' => true,
                                                'pluginOptions' => [
                                                    'tokenSeparators' => [',', ' '],
                                                    'maximumInputLength' => 10,
                                                    'allowClear' => true
                                                ],
                                            ])->label('Add Owners', ['class' => 'col-xs-12 col-md-3 form-control-label']); ?>

                                    <?= $form->field($model, 'participants', ['template' => $templateInput])
                                        ->widget(Select2::classname(),
                                            [
                                                'data' => $data['subscribers'],
                                                'options' => [
                                                    'multiple' => true,
                                                ],
                                                'class' => 'form-control',
                                                'maintainOrder' => true,
                                                'pluginOptions' => [
                                                    'tokenSeparators' => [',', ' '],
                                                    'maximumInputLength' => 10,
                                                    'allowClear' => true
                                                ],
                                            ])->label('Add Participants', ['class' => 'col-xs-12 col-md-3 form-control-label']); ?>

                                    <?= $form->field($model, 'project_links', ['template' => $templateInput])
                                        ->textarea([
                                            'class' => 'form-control',
                                            'data-plugin' => 'tokenfield',
                                            'tabindex' => '1',
                                            'style' => 'position: absolute; left: -10000px;',
                                            'autocomplete' => 'off',
                                            'data-inputType' => 'url',
                                            'data-delimiter' => [',', ' ']
                                        ])
                                        ->label(null, ['class' => 'col-xs-12 col-md-3 form-control-label']) ?>

                                    <?= $form->field($model, 'description', ['template' => $templateInput])
                                        ->textarea(
                                            [
                                                'class' => 'form-control',
                                                'placeholder' => 'Briefly Describe Your Project',
                                            ])
                                        ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>

                                    <?php $templateFileInput =
                                        '<div class="row">{label}<div class="col-md-9 col-xs-9 col-xl-9 col-lg-9">'.
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
                                        '<div class="row">{label}<div class="col-md-9 col-xs-9 col-xl-9 col-lg-9">'.
                                        '<div class="input-group input-group-file" data-plugin="inputGroupFile">'.
                                        Html::textInput('', $model->background, ['class' => 'form-control', 'readonly' => '']).
                                        '<span class="input-group-btn">'.
                                        '<span class="btn btn-outline btn-file">'.
                                        '<i class="icon wb-upload" aria-hidden="true"></i>{input}</span></span></div>'.
                                        '<small class="text-danger">{error}</small></div></div>'; ?>

                                    <?= $form->field($model, 'backgroundFile', ['template' => $templateFileInput])
                                        ->fileInput()
                                        ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>

                                    <?= $form->field($model, 'social_links[facebook]', ['template' => $templateInput])
                                        ->textInput([
                                            'class' => 'form-control',
                                            'value' => ArrayHelper::getValue($model->social_links, 'facebook'),
                                            'placeholder' => 'example-site.com'
                                        ])
                                        ->label('Facebook', ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>

                                    <?= $form->field($model, 'social_links[twitter]', ['template' => $templateInput])
                                        ->textInput([
                                            'class' => 'form-control',
                                            'value' => ArrayHelper::getValue($model->social_links, 'twitter'),
                                            'placeholder' => 'example-site.com'
                                        ])
                                        ->label('Twitter', ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>

                                    <?= $form->field($model, 'social_links[instagram]', ['template' => $templateInput])
                                        ->textInput([
                                            'class' => 'form-control',
                                            'value' => ArrayHelper::getValue($model->social_links, 'instagram'),
                                            'placeholder' => 'example-site.com'
                                        ])
                                        ->label('Instagram', ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>

                                    <?= $form->field($model, 'social_links[linkedin]', ['template' => $templateInput])
                                        ->textInput([
                                            'class' => 'form-control',
                                            'value' => ArrayHelper::getValue($model->social_links, 'linkedin'),
                                            'placeholder' => 'example-site.com'
                                        ])
                                        ->label('Linkedin', ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>

                                </div>
                            </div>
                            <!-- End Example Horizontal Form -->
                        </div>
                    </div>
                    <div class="tab-pane" id="exampleLine2" role="tabpanel">
                        <div class="col-md-12 col-lg-12 col-xs-12">
                            <!-- Example Horizontal Form -->
                            <div class="example-wrap">
                                <div class="example">

                                    <?= $form->field($model, 'type_id', ['template' => $templateInput])
                                        ->dropDownList(Project::$types, ['class' => 'form-control'])
                                        ->label(null, ['class' => 'form-control-label col-xs-12 col-md-3']) ?>

                                    <?= $form->field($model, 'status_id', ['template' => $templateInput])
                                        ->dropDownList(Project::$statuses, ['class' => 'form-control'])
                                        ->label(null, ['class' => 'form-control-label col-xs-12 col-md-3']) ?>

                                    <?= $form->field($model, 'budget_id', ['template' => $templateInput])
                                        ->dropDownList(Project::$budgets, ['class' => 'form-control'])
                                        ->label(null, ['class' => 'form-control-label col-xs-12 col-md-3']) ?>

                                    <?= $form->field($model, 'category_id', ['template' => $templateInput])
                                        ->dropDownList(Project::$categories, ['class' => 'form-control'])
                                        ->label(null, ['class' => 'form-control-label col-xs-12 col-md-3']) ?>

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
                                    <?= $form->field($model, 'completion_date', ['template' => $templateInput])
                                        ->textInput([
                                            'class' => 'form-control',
                                            'placeholder' => '2018-01-01',
                                            'data-plugin' => 'datepicker',
                                            'autocomplete' => 'off',
                                            'mode'=>'date',
                                            'data-format' => 'yyyy-mm-dd',
                                        ])
                                        ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>

                                    <?= $form->field($model, 'tagValues', ['template' => $templateInput])
                                        ->textInput([
                                            'class' => 'form-control',
                                            'data-plugin' => 'tokenfield',
                                            'tabindex' => '1',
                                            'value' => join(',', ArrayHelper::getColumn($model->tags, 'tag')),
                                            'style' => 'position: absolute; left: -10000px;',
                                            'autocomplete' => 'off',
                                            'data-delimiter' => [',', ' ']
                                        ])
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
                <button type="submit" onclick="$('#<?= $type ?>_form').submit();"
                        class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
