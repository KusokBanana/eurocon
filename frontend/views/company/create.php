<?php
use frontend\models\Company;
use voime\GoogleMaps\MapInput;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $company Company */

$template = '{label}<div class="col-md-9 col-xs-12">{input}<small class="text-help">{error}</small></div>';
?>
<div class="page">
    <div class="page-content container-fluid">
        <div class="row" data-plugin="matchHeight" data-by-row="true">
            <!-- First Row -->
            <!-- Completed Options Pie Widgets -->

            <!-- End Completed Options Pie Widgets -->
            <!-- Team Total Completed -->
            <div class="page-header h-100 m-b-50"
                 style="
                     background-image: url(<?= Url::to('@web/img/layer_images/communities-background.png') ?>);
                     background-size: cover;">
                <div class="text-xs-center blue-grey-800  m-xs-0">
                    <div class="font-size-50 m-b-30 blue-grey-800">Create Company</div>
                </div>
            </div>

            <!-- End Team Total Completed -->
            <!-- End First Row -->
            <!-- Second Row -->
            <!-- Personal -->

        </div>
        <!-- To Do List -->
        <div class="col-xs-12 col-xxl-12  col-xl-12 col-lg-12">
            <div class="row-lg">
                <div class="col-md-4"></div>

                <div class="col-md-4 col-xs-12">
                    <!-- Panel Floating Labels -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Fill the gaps</h3>
                        </div>
                        <div class="panel-body">
                            <?php $form = ActiveForm::begin([
                                'class' => 'fv-form fv-form-bootstrap4'
                            ]); ?>
                            <button type="submit" class="fv-hidden-submit" style="display: none; width: 0; height: 0;"></button>
                            <div class="row row-lg">
                                <div class="col-xs-12 col-xl-12 form-horizontal">
<!--                                    <div class="form-group row">-->
<!--                                        --><?//= $form->field($company, 'type', [
//                                            'template' => $template
//                                        ])->dropDownList(
//                                                [
//                                                    Company::COMMUNITY_TYPE_COMPANY => 'Company',
//                                                    Company::COMMUNITY_TYPE_TEAM => 'Team',
//                                                    Company::COMMUNITY_TYPE_PUBLIC_PAGE => 'Public Page',
//                                                    Company::COMMUNITY_TYPE_ANOTHER => 'Another',
//                                                ],
//                                                [
//                                                    'autofocus' => true,
//                                                    'prompt' => 'Choose a type',
//                                                ])->label(null, [
//                                                'class' => 'col-xs-12 col-xl-12 col-md-3 form-control-label'
//                                                ]) ?>
<!--                                    </div>-->
                                    <div class="form-group row">
                                        <?= $form->field($company, 'name', [
                                            'template' => $template
                                        ])->textInput(
                                            [
                                                'class' => 'form-control',
                                                'placeholder' => 'Build&Co',
                                            ])->label(null, [
                                            'class' => 'col-xs-12 col-xl-12 col-md-3 form-control-label'
                                        ]) ?>
                                    </div>


                                    <?= $form->field($company, 'location[name]', ['template' => $template])
                                        ->textInput(['class' => 'form-control', 'placeholder' => 'Saltsburg, Austria',
                                            'id'=>'address-input'])
                                        ->label(null, ['class' => 'col-xs-12 col-xl-12 col-md-3 form-control-label']) ?>

                                    <div class="col-xs-12 col-md-3 form-control-label"></div>
                                    <div class="col-md-9 col-xs-12 m-b-15">
                                        <?php echo MapInput::widget([
                                            'height' => '200px',
//                                    'zoom' => 3,
//                                    'center' => [51, 30],
                                            'countryInput' => 'country-input',
                                            'mapOptions' => [
                                                'maxZoom' => '15',
                                            ],
                                            'markerOptions' => [
                                                'icon'=>"'" . Yii::getAlias('@web/vendor/mapbox-js/marker-icon.png') . "'",
                                            ],
                                        ]); ?>
                                    </div>


                                    <?= $form->field($company, 'location[latitude]')
                                        ->hiddenInput(['id' => 'lat-input'])->label(false) ?>
                                    <?= $form->field($company, 'location[longitude]')
                                        ->hiddenInput(['id' => 'lng-input'])->label(false) ?>
                                    <?=Html::hiddenInput('country', null, ['id'=>'country-input']); ?>


                                    <div class="form-group row">
                                        <?php $templateWithAddon = '{label}<div class="col-xl-12 col-md-9 col-xs-12"><div class="input-group">'.
                                        '<span class="input-group-addon"><i class="icon wb-envelope" aria-hidden="true"></i></span>'.
                                        '{input}</div><small class="text-help">{error}</small></div>'; ?>
                                        <?= $form->field($company, 'email', [
                                            'template' => $templateWithAddon
                                        ])->textInput(
                                            [
                                                'class' => 'form-control',
                                                'placeholder' => 'email@email.com',
                                            ])->label(null, [
                                            'class' => 'col-xs-12 col-xl-12 col-md-3 form-control-label'
                                        ]) ?>
                                    </div>
                                    <div class="form-group row">
                                        <?php $templateWithAddon = '{label}<div class="col-xl-12 col-md-9 col-xs-12"><div class="input-group">'.
                                            '<span class="input-group-addon"><i class="icon fa-phone" aria-hidden="true"></i></span>'.
                                            '{input}</div><small class="text-help">{error}</small></div>'; ?>
                                        <?= $form->field($company, 'phone', [
                                            'template' => $templateWithAddon
                                        ])->textInput(
                                            [
                                                'class' => 'form-control',
                                                'placeholder' => '(XXX) XXXX XXX',
                                            ])->label(null, [
                                            'class' => 'col-xs-12 col-xl-12 col-md-3 form-control-label'
                                        ]) ?>
                                    </div>

                                    <?php $templateFileInput =
                                        '<div class="row">{label}<div class="col-md-9 col-xs-9 col-xl-9 col-lg-9">'.
                                        '<div class="input-group input-group-file" data-plugin="inputGroupFile">'.
                                        Html::textInput('', null, ['class' => 'form-control', 'readonly' => '']).
                                        '<span class="input-group-btn">'.
                                        '<span class="btn btn-outline btn-file">'.
                                        '<i class="icon wb-upload" aria-hidden="true"></i>{input}</span></span></div>'.
                                        '<small class="text-danger">{error}</small></div></div>'; ?>

                                    <?= $form->field($company, 'imageFile', ['template' => $templateFileInput])
                                    ->fileInput(['class' => 'image-input-with-preview'])
                                    ->label(null, ['class' => 'col-xs-12 col-xl-12 col-md-3 form-control-label']) ?>
                                    <div class="row image-input-preview-block"></div>

<!--                                    <div class="form-group row">-->
<!--                                        --><?//= $form->field($company, 'description', [
//                                            'template' => $template
//                                        ])->textarea(
//                                            [
//                                                'class' => 'form-control',
//                                                'placeholder' => 'We build...',
//                                                'rows' => '3',
//                                            ])->label(null, [
//                                            'class' => 'col-xs-12 col-xl-12 col-md-3 form-control-label'
//                                        ]) ?>
<!--                                    </div>-->

                                    <?= $form->field($company, 'birthday', ['template' => $template])
                                        ->textInput([
                                            'class' => 'form-control',
                                            'placeholder' => '01-01-1980',
                                            'data-plugin' => 'datepicker',
                                            'autocomplete' => 'off',
                                            'mode'=>'date',
                                            'data-format' => 'yyyy-mm-dd',
                                        ])
                                        ->label(null, ['class' => 'col-xs-12 col-xl-12 col-md-3 form-control-label']) ?>

                                </div>
                                <div class="form-group col-xs-12 col-xl-12 text-xs-center padding-top-m">
                                    <?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>
                                </div>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>
                    <!-- End Panel Floating Labels -->
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </div>
    <!-- End To Do List -->

    <!-- Recent Activity -->

    <!-- End Recent Activity -->
    <!-- End Second Row -->
</div>
