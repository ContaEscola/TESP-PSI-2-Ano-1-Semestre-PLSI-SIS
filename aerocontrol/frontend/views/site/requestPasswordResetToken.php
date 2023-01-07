<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\PasswordResetRequestForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Resetar Password';
?>

<div class="padding-block-700 height-100 d-grid align-items-center">
    <div class="container" data-type="extra-small-md">
        <h1 class="fs-500 fw-bold text-align-center">Repor password</h1>
        <?php $form = ActiveForm::begin([
            'errorCssClass' => 'invalid',
            'requiredCssClass' => 'invalid',
            'successCssClass' => 'valid',
            'validateOnType' => true,
            'validationDelay' => 500,
            'fieldConfig' => ['radioTemplate' => '{beginLabel}{input}{labelTitle}{endLabel}'],
            'options' => [
                'class' => 'margin-top-100',
            ]
        ]) ?>
            <div class="flow" data-flow-space="large">
            <?= $form->field($model, 'email', [
                'errorOptions' => [
                    'tag' => 'p',
                    'class' => 'input__error margin-top-100 '
                ],
                'options' => ['class' => 'form__group gap-0'],
            ])
                ->label(null, [
                    'class' => '[ input__label ] [ margin-bottom-50 ]'
                ])
                ->textInput([
                    'class' => 'form__input',
                    'type' => 'email',
                ]) ?>

            <?= Html::submitButton('Repor', [
                'class' => 'form__submit-button button fill-sm d-block push-to-center-md',
                'data-size' => 'large-md',
            ]) ?>

            </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>