<?php
use frontend\models\Project;
use frontend\models\ProjectTimeline;
use kartik\select2\Select2;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JqueryAsset;
use yii\widgets\ActiveForm;

/* @var $type string */
/* @var $model ProjectTimeline */
/* @var $data array */
/* @var $this \yii\web\View */

$templateInput = '<div class="row">{label}<div class="col-md-9 col-xs-9 col-xl-9 col-lg-9">{input}'.
    '<small class="text-danger">{error}</small></div></div>';
?>

<div class="modal fade" id="<?= $type ?>" aria-labelledby="exampleModalTabs" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="exampleModalTabs">Edit TimeLine</h4>
            </div>
            <div class="modal-body">

                <?php $form = ActiveForm::begin([
                    //                                'enableAjaxValidation' => true,
                    'id' => $type . '_form',
                    'successCssClass' => '',
                    'action' => Url::to(['timeline', 'id' => $model->id, 'project_id' => $model->project_id]),
                    'options' => ['enctype' => 'multipart/form-data']
                ]); ?>


                <div class="col-md-12 col-lg-12 col-xs-12">
                    <!-- Example Horizontal Form -->
                    <div class="example-wrap">
                        <div class="example">

                            <?= $form->field($model, 'title', ['template' => $templateInput])
                                ->textInput(['class' => 'form-control', 'autocomplete' => 'off'])
                                ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>

                            <?= $form->field($model, 'text', ['template' => $templateInput])
                                ->textarea(['class' => 'form-control', 'rows' => 6])
                                ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>

                            <?= $form->field($model, 'date', ['template' => $templateInput])
                                ->textInput([
                                    'class' => 'form-control',
                                    'placeholder' => '01.01.2000',
                                    'data-plugin' => 'datepicker',
                                    'mode'=>'date',
                                    'data-format' => 'yyyy-mm-dd',
                                ])
                                ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>

                            <?= $form->field($model, 'media_type_id', ['template' => $templateInput])
                                ->radioList([
                                    ProjectTimeline::MEDIA_TYPE_IMAGE => 'Image',
                                    ProjectTimeline::MEDIA_TYPE_VIDEO => 'Video'
                                ], ['class' => 'col-md-9 col-xs-9 col-xl-9 col-lg-9',
                                    'item' => function($index, $label, $name, $checked, $value) {
                                        $checked = $checked ? ' checked ' : '';
                                        $return = '<div class="radio-custom radio-primary d-inline-block m-r-10">';
                                        $return .= '<input type="radio" class="project-timeline-radio" '. $checked .
                                            ' name="' . $name . '" id="'.$name.'-'.$index.'" '.
                                            'value="' . $value . '">';
                                        $return .= '<label for="'.$name.'-'.$index.'" '.'">'.$label.'</label>';
                                        $return .= '</div>';

                                        return $return;
                                }])
                                ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']); ?>

                            <div class="project-timeline-media-block"
                                 style="<?= $model->media_type_id == ProjectTimeline::MEDIA_TYPE_VIDEO ||
                                    !$model->media_type_id ? 'display:none;' : ''?>"
                                 data-type="<?= ProjectTimeline::MEDIA_TYPE_IMAGE ?>">
                                <?php $templateFileInput =
                                    '<div class="row">{label}<div class="col-md-9 col-xs-9 col-xl-9 col-lg-9">'.
                                    '<div class="input-group input-group-file" data-plugin="inputGroupFile">'.
                                    Html::textInput('',
                                        ($model->media_type_id == ProjectTimeline::MEDIA_TYPE_IMAGE && $model->media_src ?
                                            $model->media_src : ''),
                                        ['class' => 'form-control', 'readonly' => '']).
                                    '<span class="input-group-btn">'.
                                    '<span class="btn btn-outline btn-file">'.
                                    '<i class="icon wb-upload" aria-hidden="true"></i>{input}</span></span></div>'.
                                    '<small class="text-danger">{error}</small></div></div>'; ?>

                                <?= $form->field($model, 'image_files[]', ['template' => $templateFileInput])
                                    ->fileInput(['multiple' => 'multiple', 'accept' => 'image/*'])
                                    ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>
                            </div>

                            <div class="project-timeline-media-block"
                                 style="<?= $model->media_type_id == ProjectTimeline::MEDIA_TYPE_IMAGE ||
                                    !$model->media_type_id ? 'display:none;' : ''?>"
                                 data-type="<?= ProjectTimeline::MEDIA_TYPE_VIDEO ?>">
                                <?php $templateFileInput =
                                    '<div class="row">{label}<div class="col-md-9 col-xs-9 col-xl-9 col-lg-9">'.
                                    '<div class="input-group input-group-file" data-plugin="inputGroupFile">'.
                                    Html::textInput('',
                                        ($model->media_type_id == ProjectTimeline::MEDIA_TYPE_VIDEO && $model->media_src ?
                                            $model->media_src : ''),
                                        ['class' => 'form-control', 'readonly' => '']).
                                    '<span class="input-group-btn">'.
                                    '<span class="btn btn-outline btn-file">'.
                                    '<i class="icon wb-upload" aria-hidden="true"></i>{input}</span></span></div>'.
                                    '<small class="text-danger">{error}</small></div></div>'; ?>

                                <?= $form->field($model, 'video', ['template' => $templateFileInput])
                                    ->fileInput(['accept' => 'video/*'])
                                    ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>
                            </div>

                        </div>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" onclick="$('#project_timeline_edit_form').submit();"
                        class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
