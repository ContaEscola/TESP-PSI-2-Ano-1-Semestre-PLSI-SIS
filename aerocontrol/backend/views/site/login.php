<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */


$this->title = 'Login';
?>
<main>
    <div class="padding-block-700 height-100 d-grid align-items-center">
        <div class="container" data-type="small-md">
            <h1 class="fs-600 fw-bold text-align-center">Login</h1>
            <form action="#" method="POST" class="margin-top-600 flow" data-flow-space="large">
                <div class="flow">
                    <div class="form__group">
                        <label for="username" class="[ input__label ] [ margin-bottom-50 ]">Username:</label>
                        <input class="form__input" type="text" name="{TOCHANGE}" id="username" required>
                        <p class="[ input__error ] [ margin-top-100 ]"></p>
                    </div>
                    <div class="form__group">
                        <label for="password" class="[ input__label ] [ margin-bottom-50 ]">Password:</label>
                        <input class="form__input" type="password" name="{TOCHANGE}" id="password" required>
                        <p class="[ input__error ] [ margin-top-100 ]"></p>
                    </div>
                    <div class="d-flex gap-1 align-items-center">
                        <input type="checkbox" name="{TOCHANGE}" id="save_session">
                        <label for="save_session" class="fs-200 letter-spacing-2">Guardar sessão</label>
                    </div>
                </div>
                <div class="d-flex gap-1 flex-flow-column-sm justify-content-space-between-md">
                    <a href="#" class="fs-200 letter-spacing-2">Esqueceu da password?</a>
                    <a href="#" class="fs-200 letter-spacing-2">Não tem conta?</a>
                </div>
                <button type="submit" class="form__submit-button button fill-sm d-block push-to-center-md"
                        data-size="large-md">Login</button>
            </form>
        </div>
    </div>
</main>