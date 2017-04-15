<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
$this->params['body-class'] = 'page-login';
$this->registerCssFile('@web/css/login.min.css')
?>

<div class="brand">
    <h2 class="brand-text">Eurocon</h2>
</div>
<p>Sign into your pages account</p>
<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

    <?= $form->field($model, 'email')
        ->textInput(['autofocus' => true, 'placeholder' => 'Email'])->label(null, [
            'class' => 'sr-only'
        ]) ?>
    <?= $form->field($model, 'password')
        ->passwordInput(['autofocus' => true, 'placeholder' => 'Password'])->label(null, [
            'class' => 'sr-only'
        ]) ?>

    <div class="form-group clearfix">
        <div class="checkbox-custom checkbox-inline checkbox-primary pull-xs-left">
            <?= $form->field($model, 'rememberMe', ['template' => '{input}{label}'])->checkbox([], null) ?>
        </div>
        <a class="pull-xs-right" href="forgot-password.html">Forgot password?</a>
    </div>
<?= Html::submitButton('Sign in', ['class' => 'btn btn-primary btn-block']) ?>
<?php ActiveForm::end(); ?>
<p>Still no account? Please go to <?= Html::a('Register', ['signup']) ?></p>
