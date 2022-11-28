<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Flight $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="flight-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'terminal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estimated_departure_date')->textInput() ?>

    <?= $form->field($model, 'estimated_arrival_date')->textInput() ?>

    <?= $form->field($model, 'departure_date')->textInput() ?>

    <?= $form->field($model, 'arrival_date')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'distance')->textInput() ?>

    <?= $form->field($model, 'state')->dropDownList([ 'Previsto' => 'Previsto', 'Chegou' => 'Chegou', 'Partiu' => 'Partiu', 'Cancelado' => 'Cancelado', 'Embarque' => 'Embarque', 'Ultima Chamada' => 'Ultima Chamada', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'discount_percentage')->textInput() ?>

    <?= $form->field($model, 'origin_airport_id')->textInput() ?>

    <?= $form->field($model, 'arrival_airport_id')->textInput() ?>

    <?= $form->field($model, 'airplane_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
