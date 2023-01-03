<?php

use common\models\EmployeeFunction;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\EmployeeFunction $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="employee-function-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'state')->dropDownList([EmployeeFunction::STATE_INACTIVE => 'Inativo', EmployeeFunction::STATE_ACTIVE => 'Ativo'], [
        'class' => 'form-control'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
