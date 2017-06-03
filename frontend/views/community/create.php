<?php
use frontend\assets\AppAsset;
use frontend\models\Community;
use frontend\models\Company;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $community Community */

$this->registerJsFile('@web/js/Plugin/input-group-file.min.js',  ['depends' => [AppAsset::className()]]);

$template = '<div class="row">{label}<div class="col-md-9 col-xs-9 col-xl-9 col-lg-9">{input}'
    .'<small class="text-help">{error}</small></div></div>';
?>

<div class="page">
    <div class="page-content container-fluid">
        <div class="row" data-plugin="matchHeight" data-by-row="true">
            <!-- First Row -->
            <!-- Completed Options Pie Widgets -->

            <!-- End Completed Options Pie Widgets -->
            <!-- Team Total Completed -->
            <div class="page-header h-100 m-b-50" style="background-image: url(file:../add-images/communities-background.png);  background-size: cover;">
                <div class="text-xs-center blue-grey-800  m-xs-0">
                    <div class="font-size-50 m-b-30 blue-grey-800">Create Community</div>
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
                <div class="col-sm-2 col-md-2 col-lg-3"></div>

                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-6">
                    <!-- Panel Floating Labels -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Fill the gaps</h3>
                        </div>
                        <div class="panel-body">
                            <?php $form = ActiveForm::begin([
                                'class' => 'fv-form fv-form-bootstrap4',
                                'options' => [
                                    'autocomplete' => 'off',
                                ]
                            ]); ?>
                                <button type="submit" class="fv-hidden-submit" style="display: none; width: 0px; height: 0px;"></button>
                                <div class="row row-lg">
                                    <div class="col-xs-12 col-xl-12 form-horizontal">

                                        <?= $form->field($community, 'name', [
                                            'template' => $template
                                        ])->textInput(
                                            [
                                                'class' => 'form-control',
                                                'placeholder' => 'The best wood tables',
                                            ])->label(null, [
                                            'class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label'
                                        ]) ?>

                                        <?= $form->field($community, 'tagValues', ['template' => $template])
                                            ->textInput([
                                                'class' => 'form-control',
                                                'data-plugin' => 'tokenfield',
                                                'style' => 'position: absolute; left: -10000px;',
                                                'autocomplete' => 'off'
                                            ])
                                            ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>

                                        <?php $templateFileInput =
                                            '<div class="form-group row">{label}<div class="col-md-9 col-xs-9 col-xl-9 col-lg-9">'.
                                            '<div class="input-group input-group-file" data-plugin="inputGroupFile">'.
                                            Html::textInput('', $community->image, ['class' => 'form-control', 'readonly' => '']).
                                            '<span class="input-group-btn">'.
                                            '<span class="btn btn-outline btn-file">'.
                                            '<i class="icon wb-upload" aria-hidden="true"></i>{input}</span></span></div>'.
                                            '<small class="text-danger">{error}</small></div></div>'; ?>

                                        <?= $form->field($community, 'imageFile', ['template' => $templateFileInput])
                                            ->fileInput()
                                            ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>

                                        <?php $templateFileInput =
                                            '<div class="form-group row">{label}<div class="col-md-9 col-xs-9 col-xl-9 col-lg-9">'.
                                            '<div class="input-group input-group-file" data-plugin="inputGroupFile">'.
                                            Html::textInput('', $community->background, ['class' => 'form-control', 'readonly' => '']).
                                            '<span class="input-group-btn">'.
                                            '<span class="btn btn-outline btn-file">'.
                                            '<i class="icon wb-upload" aria-hidden="true"></i>{input}</span></span></div>'.
                                            '<small class="text-danger">{error}</small></div></div>'; ?>

                                        <?= $form->field($community, 'backgroundFile', ['template' => $templateFileInput])
                                            ->fileInput()
                                            ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>

                                        <?= $form->field($community, 'post_ability_id', ['template' => $template])
                                            ->dropDownList(Community::$post_abilities, ['class' => 'form-control'])
                                            ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>

                                        <?= $form->field($community, 'acceptance_id', ['template' => $template])
                                            ->dropDownList(Community::$acceptance, ['class' => 'form-control'])
                                            ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>


                                    </div>
                                    <div class="form-group col-xs-12 col-xl-12 text-xs-center padding-top-m">
                                        <button type="submit" class="btn btn-primary" id="validateButton1">Create</button>
                                    </div>

                                </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>


                    <!-- End Panel Floating Labels -->
                </div>


                <div class="col-sm-2 col-md-2 col-lg-3"></div>
            </div>
        </div>
    </div>
    <!-- End To Do List -->

    <!-- Recent Activity -->

    <!-- End Recent Activity -->
    <!-- End Second Row -->
</div>
