<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $model \common\models\LoginForm */
/* @var $type string */

$isAjax = \yii\helpers\ArrayHelper::getValue($data, 'isAjax', false);
?>
<?php if (!$isAjax): ?>
<div class="modal fade" id="ajaxSignModal" aria-labelledby="exampleGrid"
     role="dialog" tabindex="-1" data-href=""
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
                        <p>Sign into your pages account</p>
                        <?php
                        $form = ActiveForm::begin([
                            'options' => ['data-type' => 'login']
                        ]); ?>

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
                            <?= Html::a('Forgot password?', ['/site/request-password-reset'],
                                ['class' => 'pull-xs-right']) ?>
                        </div>
                        <?= Html::submitButton('Sign in', ['class' => 'btn btn-primary btn-block']) ?>

                        <p>
                            Still no account? Please <a class="ajax-sign-toggle" data-type="signup" href="#">Register</a>
                        </p>

                        <?php ActiveForm::end(); ?>
                    </div>
<?php if (!$isAjax): ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
