<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Employee $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'employee_id')->textInput() ?>

    <?= $form->field($model, 'tin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'num_emp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ssn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'street')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zip_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'iban')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'qualifications')->dropDownList([ 'Até ao 9º ano de escolaridade' => 'Até ao 9º ano de escolaridade', 'Secundário' => 'Secundário', 'Curso técnico superior profissional' => 'Curso técnico superior profissional', 'Diploma de Especialização Tecnológica' => 'Diploma de Especialização Tecnológica', 'Ensino superior - bacharelato ou equivalente' => 'Ensino superior - bacharelato ou equivalente', 'Licenciatura Pré-Bolonha' => 'Licenciatura Pré-Bolonha', 'Licenciatura 1º Ciclo - Pós-Bolonha' => 'Licenciatura 1º Ciclo - Pós-Bolonha', 'Mestrado' => 'Mestrado', 'Doutoramento' => 'Doutoramento', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'function_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
