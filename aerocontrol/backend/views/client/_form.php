<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Client $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="client-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'client_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model->user, 'username')->textInput() ?>

    <?= $form->field($model->user, 'first_name')->textInput() ?>

    <?= $form->field($model->user, 'last_name')->textInput() ?>

    <?= $form->field($model->user, 'email')->textInput() ?>

    <?= $form->field($model->user, 'phone_country_code')->textInput() ?>

    <?= $form->field($model->user, 'phone')->input('number') ?>

    <?= $form->field($model->user, 'gender')->dropDownList([ 'Masculino' => 'Masculino','Feminino' => 'Feminino','Outro' => 'Outro' ]) ?>

    <?= $form->field($model->user, 'country')->textInput() ?>

    <?= $form->field($model->user, 'city')->textInput() ?>

    <?= $form->field($model->user, 'birthdate')->input('date') ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
