<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Flight $model */
/** @var yii\bootstrap5\ActiveForm $form */
?>

<div class="flight-form">

    <?php $form = ActiveForm::begin([
        'validateOnType' => true,
        'validationDelay' => 500,
    ]); ?>

    <?= $form->field($model, 'terminal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estimated_departure_date')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'estimated_arrival_date')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'departure_date')->input('datetime-local') ?>

    <?= $form->field($model, 'arrival_date')->input('datetime-local') ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'distance')->textInput() ?>

    <?= $form->field($model, 'state')->dropDownList([ 'Previsto' => 'Previsto', 'Chegou' => 'Chegou', 'Partiu' => 'Partiu', 'Cancelado' => 'Cancelado', 'Embarque' => 'Embarque', 'Ultima Chamada' => 'Ultima Chamada', ], ['class' => 'form-control']) ?>

    <?= $form->field($model, 'discount_percentage')->textInput() ?>

    <?= $form->field($model, 'origin_airport_id')->dropDownList($model->possible_flight_airports_for_dropdown, [
            'class' => 'form-control',
    ]) ?>

    <?= $form->field($model, 'arrival_airport_id')->dropDownList($model->possible_flight_airports_for_dropdown, [
        'class' => 'form-control',
    ]) ?>

    <?= $form->field($model, 'airplane_id')->dropDownList($model->possible_flight_airplanes_for_dropdown, [
        'class' => 'form-control',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
