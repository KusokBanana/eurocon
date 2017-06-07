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
/* @var $model Person */
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
                <h4 class="modal-title" id="exampleModalTabs">Setting</h4>
            </div>
            <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                <li class="nav-item" role="presentation"><a class="nav-link active" data-toggle="tab" href="#exampleLine1" aria-controls="exampleLine1" role="tab">My Profile</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#exampleLine2" aria-controls="exampleLine2" role="tab">Personal information</a></li>
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

                                    <?= $form->field($model, 'surname', ['template' => $templateInput])
                                        ->textInput(['class' => 'form-control', 'placeholder' => 'Name',
                                            'autocomplete' => 'off'])
                                        ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>

                                    <?= $form->field($model, 'gender_id', ['template' => $templateInput])
                                        ->radioList(Person::$genders,
                                            ['class' => 'col-md-9 col-xs-9 col-xl-9 col-lg-9',
                                            'item' => function($index, $label, $name, $checked, $value) {
                                                $checked = $checked ? ' checked ' : '';
                                                $return = '<div class="radio-custom radio-default radio-inline m-l-10">';
                                                $return .= '<input type="radio" class="project-timeline-radio" '. $checked .
                                                    ' name="' . $name . '" id="'.$name.'-'.$index.'" '.
                                                    'value="' . $value . '">';
                                                $return .= '<label for="'.$name.'-'.$index.'" '.'">'.$label.'</label>';
                                                $return .= '</div>';

                                                return $return;
                                            }])
                                        ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']); ?>

                                    <?= $form->field($model, 'position', ['template' => $templateInput])
                                        ->textInput(['class' => 'form-control', 'placeholder' => 'parquet producer',
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
                                            'data-delay' => 100,
                                            'value' => join(',', ArrayHelper::getColumn($model->ownTags, 'tag')),
//                                            'style' => 'position: absolute; left: -10000px;',
//                                            'autocomplete' => 'off',
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

                                    <?= $form->field($model, 'site', ['template' => $templateInput])
                                        ->textInput(['class' => 'form-control', 'placeholder' => 'example-site.com',
                                            'autocomplete' => 'off'])
                                        ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>

                                    <div class="row form-group">
                                        <?= $form->field($model, 'language_ids')
                                            ->hiddenInput(['id' => 'lang_ids'])
                                            ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']) ?>
                                        <div class="col-md-9 col-xs-9 col-xl-9 col-lg-9">
                                            <?= Html::listBox('langs', explode(',', $model->language_ids), Person::$languages, [
                                                'class' => 'form-control',
                                                'multiple' => '',
                                                'id' => 'selectMulti'
                                            ]) ?>
                                        </div>
<!--                                        --><?//= Html::hiddenInput('language_ids', join(',', $model->language_ids),
//                                            ['id' => 'lang_ids']) ?>
                                    </div>

                                    <?php
                                    $script = <<< JS
                                        $('body').on('mousedown', '#selectMulti option', function(e) {
                                                e.preventDefault();
                                                // $(this).prop('selected', !$(this).prop('selected'));
                                                // $(this).prop('selected', !$(this).prop('selected'));
                                                
                                                var select = $(this).closest('select');
                                                var value = (select.val() && select.val() !== null) ? select.val() : [];
                                                var optionValue = $(this).val();
                                                if (!$(this).prop('selected')) {
                                                    value.push(optionValue);
                                                } else {
                                                    value.splice(value.indexOf(optionValue), 1);
                                                }
                                                select.val(value);
                                                
                                                value = (value.length) ? value.join(',') : '';
                                                $('#lang_ids').val(value);
                                                
                                                return false;
                                        });
JS;
                                    //маркер конца строки, обязательно сразу, без пробелов и табуляции
                                    $this->registerJs($script, yii\web\View::POS_READY);

                                    ?>
                                </div>
                            </div>
                            <!-- End Example Horizontal Form -->
                        </div>

                    </div>
                    <div class="tab-pane" id="exampleLine3" role="tabpanel">
                        <div class="col-md-12 col-lg-12 col-xs-12">
                            <!-- Modal for edit -->
                            <div class="example-wrap">
                                <div class="example">

                                    <?= $form->field($model, 'notice_ids', ['options' => ['class' => 'form-group row']])
                                        ->checkboxList([
                                            Person::NOTICE_FRIENDS => 'Friends',
                                            Person::NOTICE_COMMUNITIES => 'Communities',
                                            Person::NOTICE_COMPANIES => 'Companies'
                                        ], ['class' => 'col-md-9 col-xs-9 col-xl-9 col-lg-9',
                                            'item' => function($index, $label, $name, $checked, $value) {
                                                $checked = $checked ? ' checked ' : '';
                                                $return = '<div class="checkbox-custom checkbox-default checkbox-inline">';
                                                $return .= '<input type="checkbox" '. $checked .
                                                    ' name="' . $name . '" id="'.$name.'-'.$index.'" '.
                                                    'value="' . $value . '">';
                                                $return .= '<label for="'.$name.'-'.$index.'" '.'">'.$label.'</label>';
                                                $return .= '</div>';

                                                return $return;
                                            }])
                                        ->label(null, ['class' => 'col-xs-3 col-md-3 col-xl-3 col-lg-3 form-control-label']); ?>

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
                            <!-- End Modal for edit -->
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
