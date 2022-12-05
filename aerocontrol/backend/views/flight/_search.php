<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\FlightSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="flight-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'terminal') ?>

    <?= $form->field($model, 'estimated_departure_date') ?>

    <?= $form->field($model, 'estimated_arrival_date') ?>

    <?= $form->field($model, 'departure_date') ?>

    <?php // echo $form->field($model, 'arrival_date') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'distance') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'discount_percentage') ?>

    <?php // echo $form->field($model, 'origin_airport_id') ?>

    <?php // echo $form->field($model, 'arrival_airport_id') ?>

    <?php // echo $form->field($model, 'airplane_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
