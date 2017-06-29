<?php
use voime\GoogleMaps\MapInput;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $model \frontend\models\SignupForm */
/* @var $type string */

$isAjax = \yii\helpers\ArrayHelper::getValue($data, 'isAjax', false);
?>
<?php if (!$isAjax): ?>
<div class="modal fade" id="ajaxSignModal" aria-labelledby="exampleGrid" role="dialog"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="page vertical-align text-xs-center" data-animsition-in="fade-in" data-animsition-out="fade-out">
                <div class="page-content vertical-align-middle">

                    <div class="brand">
                        <?= Html::img('@web/img/layer_images/logo.black.png',
                            ['class' => 'brand-img m-b-10', 'style' => 'width: 15%; height: 15%;']) ?>
                    </div>
<?php endif; ?>
                    <div class="ajax-content-block">

                        <p>Sign up to build interesting thing</p>
                        <?php $form = ActiveForm::begin([
                                'options' => ['data-type' => 'signup']
                        ]); ?>
                        <?= $form->field($model, 'email')
                            ->textInput(['autofocus' => true, 'placeholder' => 'Email'])->label(null, [
                                'class' => 'sr-only'
                            ]) ?>
                        <?= $form->field($model, 'password')
                            ->passwordInput(['autofocus' => true, 'placeholder' => 'Password'])->label(null, [
                                'class' => 'sr-only'
                            ]) ?>
                        <?= $form->field($model, 'confirm_password')
                            ->passwordInput(['autofocus' => true, 'placeholder' => 'Confirm Password'])->label(null, [
                                'class' => 'sr-only'
                            ]) ?>
                        <?= $form->field($model, 'name')
                            ->textInput(['autofocus' => true, 'placeholder' => 'Name'])->label(null, [
                                'class' => 'sr-only'
                            ]) ?>
                        <?= $form->field($model, 'surname')
                            ->textInput(['autofocus' => true, 'placeholder' => 'Last Name'])->label(null, [
                                'class' => 'sr-only'
                            ]) ?>
<!--                        --><?//= $form->field($model, 'country')
//                            ->dropDownList([], [
//                                'autofocus' => true,
//                                'id' => 'geoCountry',
//                            ])->label(null, [
//                                'class' => 'sr-only'
//                            ]) ?>
<!--                        --><?//= $form->field($model, 'city')
//                            ->dropDownList([], [
//                                'autofocus' => true,
//                                'placeholder' => 'Select a city ...',
//                                'id' => 'geoCity'
//                            ])->label(null, [
//                                'class' => 'sr-only'
//                            ]) ?>

                        <?= $form->field($model, 'location[name]')
                            ->textInput(['placeholder' => 'Saltsburg, Austria',
                                'id'=>'address-input', 'required' => ''])
                            ->label(null, ['class' => 'sr-only']) ?>

                        <?php echo MapInput::widget([
                            'height' => '0',
                            'countryInput' => 'country-input'
                        ]); ?>

                        <?= $form->field($model, 'location[latitude]', ['template' => '{input}', 'options' => ['class' => 'hidden']])
                            ->hiddenInput(['id' => 'lat-input'])->label(false) ?>
                        <?= $form->field($model, 'location[longitude]', ['template' => '{input}', 'options' => ['class' => 'hidden']])
                            ->hiddenInput(['id' => 'lng-input'])->label(false) ?>
                        <?=Html::hiddenInput('', null, ['id'=>'country-input']); ?>

                        <?= $form->field($model, 'phone')
                            ->textInput(['autofocus' => true, 'placeholder' => 'Phone'])->label(null, [
                                'class' => 'sr-only'
                            ]) ?>
                        <script>initialize();</script>
                        <?= Html::submitButton('Register', ['class' => 'btn btn-primary btn-block']) ?>
                        <?php ActiveForm::end(); ?>

                        <p>
                            Have account already? Please <a class="ajax-sign-toggle" data-type="login" href="#">login</a>
                        </p>

                    </div>
<?php if (!$isAjax): ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>