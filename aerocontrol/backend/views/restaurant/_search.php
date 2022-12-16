<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\RestaurantSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="restaurant-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'phone') ?>

    <?= $form->field($model, 'open_time') ?>

    <?php // echo $form->field($model, 'close_time') ?>

    <?php // echo $form->field($model, 'logo') ?>

    <?php // echo $form->field($model, 'website') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
