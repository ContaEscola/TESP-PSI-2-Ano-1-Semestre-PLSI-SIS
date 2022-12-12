<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;
use kartik\time\TimePicker;

/** @var yii\web\View $this */
/** @var common\models\Restaurant $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="restaurant-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'open_time')->widget(TimePicker::className(),[
        'pluginOptions' => [
            'showMeridian' => false,
            'minuteStep' => 1,
        ]
    ]) ?>

    <?= $form->field($model, 'close_time')->widget(TimePicker::className(),[
        'pluginOptions' => [
            'showMeridian' => false,
            'minuteStep' => 1,
        ]
    ]) ?>

    <?= $form->field($model, 'logo')->widget(FileInput::classname(), [
        'name' => 'Restaurant[logo]',
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'initialPreview'=>Url::to(['../../images/restaurant/'.$model->logo]),
            'initialPreviewAsData'=>true,
            'initialCaption'=>"$model->logo",
            'initialPreviewConfig' => [
                ['caption' => $model->logo],
            ],
        ]
    ])?>

    <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
