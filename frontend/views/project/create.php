<?php

/* @var $this \yii\web\View*/
/* @var $newProject \frontend\models\Project */
/* @var $follows array */

use dosamigos\selectize\SelectizeTextInput;
use frontend\models\Project;
use justinvoelker\tagging\TaggingWidget;
use pudinglabs\tagsinput\TagsinputWidget;
use voime\GoogleMaps\MapInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use dosamigos\taggable\Taggable;

$this->registerCssFile('@web/css/jquery-wizard.min.css');
$this->registerCssFile('@web/css/formValidation.min.css');

//$this->registerJsFile('@web/js/assets/jquery-wizard.min.js', ['position' => \yii\web\View::POS_LOAD]);
//$this->registerJsFile('@web/js/assets/matchheight.min.js', ['position' => \yii\web\View::POS_LOAD]);
//$this->registerJsFile('@web/vendor/formvalidation/formValidation.js', ['position' => \yii\web\View::POS_LOAD]);
//$this->registerJsFile('@web/vendor/formvalidation/framework/bootstrap.js', ['position' => \yii\web\View::POS_LOAD]);
//$this->registerJsFile('@web/js/assets/wizard.min.js', ['position' => \yii\web\View::POS_LOAD]);

$templateInput = '<div class="row">{label}<div class="col-md-9 col-xs-12">{input}'.
    '<small class="text-danger">{error}</small></div></div>';
?>

<div class="page-header h-100 m-b-30" style="background-image: url();  background-size: cover;">
    <div class="text-xs-center blue-grey-800 m-t-0 m-xs-0">
        <div class="font-size-40 m-b-30 blue-grey-800">Single Project Builder</div>

    </div>
</div>
<div class="page">
    <div class="page-content container-fluid">
        <div class="row">

            <div class="col-lg-12 col-xs-12">
                <!-- Panel Wizard Form Container -->
                <div class="panel" id="exampleWizardForm">
                    <div class="panel-heading">
                        <h3 class="panel-title">Start your project</h3>
                    </div>
                    <div class="panel-body">
                        <!-- Steps -->
                        <div class="pearls row">
                            <div class="pearl current col-xs-4">
                                <div class="pearl-icon"><i class="icon wb-user" aria-hidden="true"></i></div>
                                <span class="pearl-title">Add info</span>
                            </div>
                            <div class="pearl col-xs-4">
                                <div class="pearl-icon"><i class="icon wb-order" aria-hidden="true"></i></div>
                                <span class="pearl-title">Add details</span>
                            </div>
                            <div class="pearl col-xs-4">
                                <div class="pearl-icon"><i class="icon wb-check" aria-hidden="true"></i></div>
                                <span class="pearl-title">Publish project</span>
                            </div>
                        </div>
                        <!-- End Steps -->
                        <!-- Wizard Content -->
                        <?php $form = ActiveForm::begin([
                                'options' => ['class' => 'wizard-content'],
                                'id' => 'exampleFormContainer',
//                                'enableAjaxValidation' => true,
                                'successCssClass' => '',
                        ]); ?>

                            <div class="wizard-pane active" id="exampleAccountOne" role="tabpanel">
                                <?= $form->field($newProject, 'name', ['template' => $templateInput])
                                    ->textInput(['class' => 'form-control', 'placeholder' => 'Great project №1',
                                        'autocomplete' => 'off'])
                                    ->label(null, ['class' => 'col-xs-12 col-md-3 form-control-label']) ?>

                                <?= $form->field($newProject, 'location[name]', ['template' => $templateInput])
                                    ->textInput(['class' => 'form-control', 'placeholder' => 'Saltsburg, Austria',
                                        'id'=>'address-input'])
                                    ->label(null, ['class' => 'col-xs-12 col-md-3 form-control-label']) ?>

                                <div class="col-xs-12 col-md-3 form-control-label"></div>
                                <div class="col-md-9 col-xs-12 m-b-15">
                                    <?php echo MapInput::widget([
                                        'height' => '200px',
                                        'width' => '50%',
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


                                <?= $form->field($newProject, 'location[latitude]')
                                    ->hiddenInput(['id' => 'lat-input'])->label(false) ?>
                                <?= $form->field($newProject, 'location[longitude]')
                                    ->hiddenInput(['id' => 'lng-input'])->label(false) ?>
                                <?=Html::hiddenInput('country', null, ['id'=>'country-input']); ?>

                                <?= $form->field($newProject, 'description', ['template' => $templateInput])
                                    ->textarea(
                                    [
                                        'class' => 'form-control',
                                        'placeholder' => 'Briefly Describe Your Project',
                                    ])
                                    ->label(null, ['class' => 'col-xs-12 col-md-3 form-control-label']) ?>

                                <?php $templateFileInput =
                                    '<div class="row">{label}<div class="col-md-9 col-xs-9 col-xl-9 col-lg-9">'.
                                    '<div class="input-group input-group-file" data-plugin="inputGroupFile">'.
                                    Html::textInput('', null, ['class' => 'form-control', 'readonly' => '']).
                                    '<span class="input-group-btn">'.
                                    '<span class="btn btn-outline btn-file">'.
                                    '<i class="icon wb-upload" aria-hidden="true"></i>{input}</span></span></div>'.
                                    '<small class="text-danger">{error}</small></div></div>'; ?>

                                <?= $form->field($newProject, 'imageFile', ['template' => $templateFileInput])
                                    ->fileInput(['class' => 'image-input-with-preview'])
                                    ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>
                                <div class="row image-input-preview-block"></div>

                                <?php $templateFileInput =
                                    '<div class="row">{label}<div class="col-md-9 col-xs-9 col-xl-9 col-lg-9">'.
                                    '<div class="input-group input-group-file" data-plugin="inputGroupFile">'.
                                    Html::textInput('', null, ['class' => 'form-control', 'readonly' => '']).
                                    '<span class="input-group-btn">'.
                                    '<span class="btn btn-outline btn-file">'.
                                    '<i class="icon wb-upload" aria-hidden="true"></i>{input}</span></span></div>'.
                                    '<small class="text-danger">{error}</small></div></div>'; ?>

                                <?= $form->field($newProject, 'backgroundFile', ['template' => $templateFileInput])
                                    ->fileInput(['class' => 'image-input-with-preview'])
                                    ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>
                                <div class="row image-input-preview-block"></div>

                            </div>

                            <div class="wizard-pane" id="exampleBillingOne" role="tabpanel">

                                <?= $form->field($newProject, 'type_id', ['template' => $templateInput])
                                    ->dropDownList(Project::$types, ['class' => 'form-control'])
                                    ->label(null, ['class' => 'col-xs-12 col-md-3 form-control-label']) ?>

                                <?= $form->field($newProject, 'status_id', ['template' => $templateInput])
                                    ->dropDownList(Project::$statuses, ['class' => 'form-control'])
                                    ->label(null, ['class' => 'col-xs-12 col-md-3 form-control-label']) ?>

                                <?= $form->field($newProject, 'budget_id', ['template' => $templateInput])
                                    ->dropDownList(Project::$budgets, ['class' => 'form-control'])
                                    ->label(null, ['class' => 'col-xs-12 col-md-3 form-control-label']) ?>

                                <?= $form->field($newProject, 'category_id', ['template' => $templateInput])
                                    ->dropDownList(Project::$categories, ['class' => 'form-control'])
                                    ->label(null, ['class' => 'col-xs-12 col-md-3 form-control-label']) ?>

                            </div>

                            <div class="wizard-pane" id="exampleGetting" role="tabpanel">

                                <?= $form->field($newProject, 'editability_id', ['template' => $templateInput])
                                    ->dropDownList(Project::$editability, ['class' => 'form-control'])
                                    ->label(null, ['class' => 'col-xs-12 col-md-3 form-control-label']) ?>

                                <?= $form->field($newProject, 'participants', ['template' => $templateInput])
                                    ->widget(Select2::classname(),
                                        [
                                            'data' => $follows,
                                            'options' => ['placeholder' => 'Search Participants..', 'multiple' => true],
                                            'class' => 'form-control',
                                            'maintainOrder' => true,
                                            'pluginOptions' => [
                                                'tokenSeparators' => [',', ' '],
                                                'maximumInputLength' => 10
                                            ],
                                        ])->label(null, ['class' => 'col-xs-12 col-md-3 form-control-label']); ?>

                                <?= $form->field($newProject, 'owners', ['template' => $templateInput])
                                    ->widget(Select2::classname(),
                                        [
                                            'data' => $follows,
                                            'options' => ['placeholder' => 'John Smith and ..', 'multiple' => true],
                                            'class' => 'form-control',
                                            'maintainOrder' => true,
                                            'pluginOptions' => [
                                                'tokenSeparators' => [',', ' '],
                                                'maximumInputLength' => 10
                                            ],
                                        ])->label(null, ['class' => 'col-xs-12 col-md-3 form-control-label']); ?>

                                <?= $form->field($newProject, 'tagValues', ['template' => $templateInput])
                                    ->textInput([
                                        'class' => 'form-control',
                                        'data-plugin' => 'tokenfield',
                                        'tabindex' => '1',
                                        'style' => 'position: absolute; left: -10000px;',
                                        'autocomplete' => 'off'
                                    ])
                                    ->label(null, ['class' => 'form-control-label col-xs-12 col-md-3']) ?>
                            </div>
                        <?php ActiveForm::end(); ?>
                            <!-- End Wizard Content -->
                    </div>
                </div>
                <!-- End Panel Wizard One Form -->
            </div>
        </div>
    </div>
</div>