<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\SupportTicket $model */
/** @var yii\widgets\ActiveForm $form */
/** @var int $ticket_id */

?>

<div class="support-ticket-form">

    <?php $form = ActiveForm::begin([
        'action' => ['view','ticket_id' =>$ticket_id],
        'errorCssClass' => 'invalid',
        'requiredCssClass' => 'invalid',
        'successCssClass' => 'valid',
        'validateOnType' => true,
        'validationDelay' => 500,
    ]);?>

    <?= $form->field($model, 'message')->textArea() ?>

    <div class="form-group">
        <?= Html::submitButton('Enviar', ['class' => '[ button ] [ d-block fill-sm margin-top-300 push-to-right-md ]']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
