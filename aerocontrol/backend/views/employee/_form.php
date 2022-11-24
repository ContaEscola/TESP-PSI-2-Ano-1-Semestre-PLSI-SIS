<?php

use backend\models\EmployeeForm;
use common\models\EmployeeFunction;
use common\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Employee $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'num_emp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_name')->textInput() ?>

    <?= $form->field($model, 'last_name')->textInput() ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?= $form->field($model, 'phone_country_code')->textInput() ?>

    <?= $form->field($model, 'phone')->input('tel') ?>

    <?= $form->field($model, 'gender')->dropDownList($possibleGenders) ?>

    <?= $form->field($model, 'tin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ssn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'iban')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'qualifications')->dropDownList($possibleQualifications, ['prompt' => '']) ?>

    <?= $form->field($model, 'function_id')->dropDownList($possibleFunctions, ['prompt' => '']) ?>

    <?= $form->field($model, 'country')->textInput() ?>

    <?= $form->field($model, 'city')->textInput() ?>

    <?= $form->field($model, 'street')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zip_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'birthdate')->input('date') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>