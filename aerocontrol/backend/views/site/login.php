<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
?>
<main>
    <div class="padding-block-700 height-100 d-grid align-items-center">
        <div class="container" data-type="small-md">
            <h1 class="fs-600 fw-bold text-align-center">Login</h1>

        <?php $form = ActiveForm::begin(['id' => 'login-form']) ?>
        <label for="username" class="[ input__label ] [ margin-bottom-50 ]">Username:</label>
        <?= $form->field($model,'username', [
            'options' => ['class' => 'form-group has-feedback'],
            'template' => '{beginWrapper}{input}{error}{endWrapper}',
            'wrapperOptions' => ['class' => 'input-group mb-3']
        ])
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>
        <label for="password" class="[ input__label ] [ margin-bottom-50 ]">Password:</label>
        <?= $form->field($model, 'password', [
            'options' => ['class' => 'form-group has-feedback'],
            'template' => '{beginWrapper}{input}{error}{endWrapper}',
            'wrapperOptions' => ['class' => 'input-group mb-3']
        ])
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>
        <div>
            <?= $form->field($model, 'rememberMe')->checkbox([
                'template' => '<div class="d-flex gap-1 align-items-center">{input}{label}</div>',
                'labelOptions' => [
                    'class' => ''
                ],
                'uncheck' => null
            ]) ?>
        </div>
        <div style="text-align: center">
            <?= Html::submitButton('Sign In', ['class' => 'btn btn-primary btn-block']) ?>
        </div>
        <?php \yii\bootstrap4\ActiveForm::end(); ?>
        </div>
    </div>
</main>

