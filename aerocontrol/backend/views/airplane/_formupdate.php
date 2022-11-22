<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Airplane $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="airplane-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'capacity')->textInput() ?>

    <?= $form->field($model, 'state')->dropDownList([ '0' => 'Inativo','1' => 'Ativo']) ?>

    <?= $form->field($model, 'company_id')->dropDownList($company_airplanes) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
