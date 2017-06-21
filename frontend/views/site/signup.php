<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
$this->params['body-class'] = 'page-register page-dark';

$this->registerCssFile('@web/css/register.min.css')
?>

<div class="brand">
    <?= Html::img('@web/img/layer_images/logo.png', [
        'style' => 'width: 15%; height: 15%;',
        'alt' => '...',
        'class' => 'brand-img'
    ]) ?>
</div>
<p>Sign up to build interesting thing</p>

<?php $form = ActiveForm::begin(); ?>
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
<!--    --><?//= $form->field($model, 'country')
//        ->textInput([
//                'autofocus' => true,
//                'placeholder' => 'Country',
//                'onFocus' => 'geolocate()',
//                'id' => 'geoAutocomplete',
//            ])->label(null, [
//            'class' => 'sr-only'
//        ]) ?>
<!--    --><?//= $form->field($model, 'city')
//        ->textInput(['autofocus' => true, 'placeholder' => 'City'])->label(null, [
//            'class' => 'sr-only'
//        ]) ?>
    <?= $form->field($model, 'phone')
        ->textInput(['autofocus' => true, 'placeholder' => 'Phone'])->label(null, [
            'class' => 'sr-only'
        ]) ?>
    <?= Html::submitButton('Register', ['class' => 'btn btn-primary btn-block']) ?>
<?php ActiveForm::end(); ?>

<p>Have account already? Please go to <?= Html::a('Sign In', ['login']) ?></p>
