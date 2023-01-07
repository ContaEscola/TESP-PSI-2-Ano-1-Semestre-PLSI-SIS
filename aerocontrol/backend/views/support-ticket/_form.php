<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var common\models\SupportTicket $model */
/** @var yii\widgets\ActiveForm $form */
/** @var int $ticket_id */
/** @var int $client_id */
/** @var yii\data\ActiveDataProvider $dataProvider */

?>

<div class="support-ticket-form">

    <?php $form = ActiveForm::begin([
        'action' => ['view','ticket_id' =>$ticket_id],
        'validateOnType' => true,
        'validationDelay' => 500,
    ]);?>

    <div class="card">
        <div class="card-body overflow-auto" data-mdb-perfect-scrollbar="true" style="position: relative; height: 450px">

            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'viewParams' => ['client_id' => $client_id],
                'summary' => '',
                'emptyText' => "<p class='fw-medium text-align-center'>Esta chat ainda não tem mensagens!</p>",
                'itemView' => '_message',
            ]); ?>


        </div>
        <div class="card-footer text-muted d-flex justify-content-start align-items-center p-3">

            <?= $form->field($model, 'message',[
                'options' => [
                        'class' => 'w-100 mr-2'
                ]
            ])->textInput([
                'class' => 'form-control'
            ])->label(false)?>
            <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary align-self-start']) ?>

        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
