<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<main>
    <?php $form = ActiveForm::begin(['id' => 'login-form']) ?>
    <div class="padding-block-700 height-100 d-grid align-items-center">
        <div class="container" data-type="small-md">
            <div class="text-align-center flow" data-flow-space="small">
                <h1 class="fs-600 fw-bold text-align-center">Criar conta</h1>
                <p>Crie a sua conta para começar a reservar voos e muito mais.</p>
            </div>
            <div class="margin-top-600 flow" data-flow-space="large">
                <?php $form = ActiveForm::begin(['id' => 'login-form']) ?>
                <div>
                    <h2 class="fs-500 fw-semi-bold text-align-center-sm">Dados de acesso</h2>
                    <div class="even-columns gap-2-sm gap-1-md margin-top-200">
                        <div class="form__group">
                            <label for="username" class="[ input__label ] [ margin-bottom-50 ]">Username:</label>
                            <?= $form->field($model,'username', [
                                'options' => ['class' => 'form-group has-feedback'],
                                'template' => '{beginWrapper}{input}{error}{endWrapper}',
                                'wrapperOptions' => ['class' => 'input-group mb-3']
                            ])
                                ->label(false)
                                ->textInput(['placeholder' => $model->getAttributeLabel('')]) ?>
                        </div>
                        <div class="form__group">
                            <label for="password" class="[ input__label ] [ margin-bottom-50 ]">Password:</label>
                            <?= $form->field($model, 'password', [
                                'options' => ['class' => 'form-group has-feedback'],
                                'template' => '{beginWrapper}{input}{error}{endWrapper}',
                                'wrapperOptions' => ['class' => 'input-group mb-3']
                            ])
                                ->label(false)
                                ->passwordInput(['placeholder' => $model->getAttributeLabel('')]) ?>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="fs-500 fw-semi-bold text-align-center-sm">Dados pessoais</h2>
                    <div class="flow margin-top-200">
                        <div class="even-columns gap-2-sm gap-1-md ">
                            <div class="form__group">
                                <label for="username" class="[ input__label ] [ margin-bottom-50 ]">Primeiro Nome:</label>
                                <?= $form->field($model,'first_name', [
                                    'options' => ['class' => 'form-group has-feedback'],
                                    'template' => '{beginWrapper}{input}{error}{endWrapper}',
                                    'wrapperOptions' => ['class' => 'input-group mb-3']
                                ])
                                    ->label(false)
                                    ->textInput(['placeholder' => $model->getAttributeLabel('')]) ?>
                            </div>
                            <div class="form__group">
                                <label for="last-name" class="[ input__label ] [ margin-bottom-50 ]">Último nome:</label>
                                <input class="form__input" type="text" name="{TOCHANGE}" id="last-name" required>
                                <p class="[ input__error ] [ margin-top-100 ]"></p>
                            </div>
                            <div class="form__group">
                                <label for="gender" class="[ input__label ] [ margin-bottom-50 ]">Género:</label>
                                <select class="[ form__input ] [ height-100 ]" name="genders" id="gender" required>
                                    <!-- Get from database -->
                                </select>
                                <p class="[ input__error ] [ margin-top-100 ]"></p>
                            </div>
                        </div>
                        <div class="d-flex flex-flow-column-sm gap-2">
                            <div class="form__group">
                                <label for="birthdate" class="[ input__label ] [ margin-bottom-50 ]">Data de Nascimento:</label>
                                <input class="form__input" type="date" name="{TOCHANGE}" id="birthdate" required>
                                <p class="[ input__error ] [ margin-top-100 ]"></p>
                            </div>
                            <div class="form__group">
                                <label for="country" class="[ input__label ] [ margin-bottom-50 ]">País:</label>
                                <input class="form__input min-width-initial " type="text" name="{TOCHANGE}" id="country" required>
                                <p class="[ input__error ] [ margin-top-100 ]"></p>
                            </div>
                            <div class="form__group">
                                <label for="city" class="[ input__label ] [ margin-bottom-50 ]">Cidade:</label>
                                <input class="form__input" type="text" name="{TOCHANGE}" id="city" required>
                                <p class="[ input__error ] [ margin-top-100 ]"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="fs-500 fw-semi-bold text-align-center-sm">Contactos</h2>
                    <div class="d-flex flex-flow-column-sm margin-top-200">
                        <div class="form__group flex-1">
                            <label for="email" class="[ input__label ] [ margin-bottom-50 ]">Email:</label>
                            <input class="form__input" type="email" name="{TOCHANGE}" id="email" required>
                            <p class="[ input__error ] [ margin-top-100 ]"></p>
                        </div>
                        <div class="form__group flex-1">
                            <label for="phone-number" class="[ input__label ] [ margin-bottom-50 ]">Contacto telefónico:</label>
                            <div class="d-flex width-100">
                                <input class="[ form__input ] [ flex-1 ]" type="text" name="{TOCHANGE}" required placeholder="Indicativo">
                                <input class=" [ form__input ] [ flex-2 ]" type="text" name="{TOCHANGE}" id="phone-number" required placeholder="Número telefone">
                            </div>
                            <p class="[ input__error ] [ margin-top-100 ]"></p>
                        </div>
                    </div>
                </div>

                <div style="text-align: center">
                    <?= Html::submitButton('Criar conta', ['class' => 'btn btn-primary btn-block']) ?>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</main>
