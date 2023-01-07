<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\ContactForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Reset password';
?>
<div class="padding-block-700 height-100 d-grid align-items-center">
    <div class="container" data-type="small-md">
        <h1 class="fs-600 fw-bold text-align-center">Contactar Suporte</h1>
        <p class="[ text-warning ] [ fs-200 letter-spacing-1 margin-top-200 fw-semi-bold ]">Esta secção ainda está em construção.</p>
        <form class="margin-top-400 flow" data-flow-space="large">

            <div class="flow" data-flow-space="small">

                <div class="form__group">
                    <label for="email" class="[ input__label ] [ margin-bottom-50 ]">Email:</label>
                    <input class="form__input" type="email" name="{TOCHANGE}" id="email" required>
                    <p class="[ input__error ] [ margin-top-50 ]"></p>
                </div>
                <div class="form__group">
                    <label for="message" class="[ input__label ] [ margin-bottom-50 ]">Mensagem:</label>
                    <textarea class="form__input resize-none" name="{TOCHANGE}" id="message" rows="12"
                        required></textarea>
                    <p class="[ input__error ] [ margin-top-50 ]"></p>
                </div>

            </div>

            <button type="submit" disabled class="form__submit-button button fill-sm d-block push-to-right-md disabled"
                data-size="large-md">Enviar</button>
        </form>
    </div>
</div>