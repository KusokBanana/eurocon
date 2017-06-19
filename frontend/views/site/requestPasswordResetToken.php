<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Request password reset';
$this->params['breadcrumbs'][] = $this->title;
$this->params['body-class'] = 'page-forgot-password';
$this->params['footer_icons_remove'] = true;
$this->registerCssFile('@web/css/forgot-password.css')
?>

<h2>Forgot Your Password ?</h2>
<p>Input your registered email to reset your password</p>
    <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

        <?= $form->field($model, 'email')
            ->input('email', ['placeholder' => 'Your Email'])->label(null, [
                'class' => 'sr-only'
            ]) ?>
    <div class="form-group">
        <?= Html::submitButton('Reset Your Password', ['class' => 'btn btn-primary btn-block']) ?>
    </div>
<?php ActiveForm::end(); ?>
