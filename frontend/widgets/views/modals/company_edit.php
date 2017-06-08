<?php
use frontend\assets\AppAsset;
use frontend\models\Person;
use frontend\models\Project;
use kartik\select2\Select2;
use voime\GoogleMaps\MapInput;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;


/* @var $type string */
/* @var $model \frontend\models\Company */
/* @var $data array */
/* @var $this \yii\web\View */

$templateInput = '<div class="row">{label}<div class="col-md-9 col-xs-9 col-xl-9 col-lg-9">{input}'.
    '<small class="text-danger">{error}</small></div></div>';
?>
<style>
    span.select2-container.select2-container--krajee.select2-container--open, div.pac-container.pac-logo.hdpi {
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
                <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab" href="#exampleLine1" aria-controls="exampleLine1" role="tab">Company Profile</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#exampleLine2" aria-controls="exampleLine2" role="tab">Company information</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#exampleLine3" aria-controls="exampleLine3" role="tab">Notifications</a></li>
            </ul>
            <div class="modal-body">
                <?php $form = ActiveForm::begin([
                    //                                'enableAjaxValidation' => true,
                    'id' => $type . '_form',
                    'successCssClass' => '',
                    'action' => Url::to(['update', 'id' => $model->id]),
                    'options' => ['enctype' => 'multipart/form-data', 'class' => 'form-horizontal'],

                ]); ?>
                    <div class="tab-content">
                        <div class="tab-pane active" id="exampleLine1" role="tabpanel">
                            <div class="col-md-12 col-lg-12 col-xs-12">
                                <!-- Example Horizontal Form -->
                                <div class="example-wrap">
                                    <div class="example">

                                        <?= $form->field($model, 'name', ['template' => $templateInput])
                                            ->textInput(['class' => 'form-control', 'placeholder' => 'Name',
                                                'autocomplete' => 'off'])
                                            ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>

                                        <?= $form->field($model, 'specialty', ['template' => $templateInput])
                                            ->textInput(['class' => 'form-control', 'placeholder' => 'Name',
                                                'autocomplete' => 'off'])
                                            ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>

                                        <?= $form->field($model, 'location[name]', ['template' => $templateInput])
                                            ->textInput(['class' => 'form-control', 'placeholder' => 'Saltsburg, Austria',
                                                'id'=>'address-input'])
                                            ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>

                                        <?php echo MapInput::widget([
                                            'height' => '150px',
//                                        'zoom' => '19',
                                            'center' => $model->location['name'],
                                            'countryInput' => 'country-input',
                                            'mapOptions' => [
                                                'maxZoom' => '15',
                                            ],
                                            'markerOptions' => [
                                                'icon'=>"'" . Yii::getAlias('@web/vendor/mapbox-js/marker-icon.png') . "'",
                                            ],
                                        ]); ?>

                                        <?= $form->field($model, 'location[latitude]')
                                            ->hiddenInput(['id' => 'lat-input'])->label(false) ?>
                                        <?= $form->field($model, 'location[longitude]')
                                            ->hiddenInput(['id' => 'lng-input'])->label(false) ?>
                                        <?=Html::hiddenInput('country', null, ['id'=>'country-input']); ?>


                                        <?= $form->field($model, 'site', ['template' => $templateInput])
                                            ->textInput(['class' => 'form-control', 'placeholder' => 'example-site.com',
                                                'autocomplete' => 'off'])
                                            ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>

                                        <?php $templateFileInput =
                                            '<div class="row">{label}<div class="col-md-9 col-xs-9 col-xl-9 col-lg-9">'.
                                            '<div class="input-group input-group-file" data-plugin="inputGroupFile">'.
                                            Html::textInput('', null, ['class' => 'form-control', 'readonly' => '']).
                                            '<span class="input-group-btn">'.
                                            '<span class="btn btn-outline btn-file">'.
                                            '<i class="icon wb-upload" aria-hidden="true"></i>{input}</span></span></div>'.
                                            '<small class="text-danger">{error}</small></div></div>'; ?>

                                        <?= $form->field($model, 'imageFile', ['template' => $templateFileInput])
                                            ->fileInput(['class' => 'image-input-with-preview'])
                                            ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>
                                        <div class="row image-input-preview-block">
                                            <?php if ($model->image): ?>
                                                <div class="col-md-4 col-xs-12">
                                                    <div class="example">
                                                        <?= Html::img($model->imageShow, [
                                                            'class' => 'img-rounded img-bordered img-bordered-primary',
                                                            'alt' => '...',
                                                        ]) ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <?php $templateFileInput =
                                            '<div class="row">{label}<div class="col-md-9 col-xs-9 col-xl-9 col-lg-9">'.
                                            '<div class="input-group input-group-file" data-plugin="inputGroupFile">'.
                                            Html::textInput('', $model->background, ['class' => 'form-control', 'readonly' => '']).
                                            '<span class="input-group-btn">'.
                                            '<span class="btn btn-outline btn-file">'.
                                            '<i class="icon wb-upload" aria-hidden="true"></i>{input}</span></span></div>'.
                                            '<small class="text-danger">{error}</small></div></div>'; ?>

                                        <?= $form->field($model, 'backgroundFile', ['template' => $templateFileInput])
                                            ->fileInput(['class' => 'image-input-with-preview'])
                                            ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>
                                        <div class="row image-input-preview-block">
                                            <?php if ($model->background): ?>
                                                <div class="col-md-4 col-xs-12">
                                                    <div class="example">
                                                        <?= Html::img($model->backgroundShow, [
                                                            'class' => 'img-rounded img-bordered img-bordered-primary',
                                                            'alt' => '...',
                                                        ]) ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>

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

                                        <?= $form->field($model, 'email', ['template' => $templateInput])
                                            ->textInput(['class' => 'form-control', 'placeholder' => '@email.com',
                                                'autocomplete' => 'off'])
                                            ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>

                                        <?= $form->field($model, 'phone', ['template' => $templateInput])
                                            ->textInput(['class' => 'form-control', 'placeholder' => '+1-541-754-3010',
                                                'autocomplete' => 'off'])
                                            ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>

                                        <?= $form->field($model, 'birthday', ['template' => $templateInput])
                                            ->textInput([
                                                'class' => 'form-control',
                                                'placeholder' => '01-01-1980',
                                                'data-plugin' => 'datepicker',
                                                'autocomplete' => 'off',
                                                'mode'=>'date',
                                                'data-format' => 'yyyy-mm-dd',
                                            ])
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

                                        <?= $form->field($model, 'chat_me_able_id', ['template' => $templateInput])
                                            ->dropDownList([
                                                Person::CAN_ONLY_FRIENDS => 'only friends',
                                                Person::CAN_FRIENDS => 'friends and friends of my friends',
                                                Person::CAN_EVERYONE => 'everyone'
                                            ], ['class' => 'form-control'])
                                            ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>

                                        <?= $form->field($model, 'invite_project_able_id', ['template' => $templateInput])
                                            ->dropDownList([
                                                Person::CAN_ONLY_FRIENDS => 'only friends',
                                                Person::CAN_FRIENDS => 'friends and friends of my friends',
                                                Person::CAN_EVERYONE => 'everyone'
                                            ], ['class' => 'form-control'])
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
                <button type="button" onclick="$('#<?= $type ?>_form').submit();" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>