<?php

use common\models\TicketItem;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SupportTicket $model */
/** @var int $ticket_id */
/** @var int $client_id */
/** @var string $ticket_title */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->registerJsFile('@web/js/scrolldown_chat.js');

$this->title = $ticket_title;
$this->params['breadcrumbs'][] = ['label' => 'Tickets de Suporte', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="support-ticket-create">

    <div class="d-flex mb-3 gap-2">
        <?= Html::a('Concluir ticket', ['finish', 'ticket_id' => $ticket_id], ['class' => 'btn btn-primary']) ?>
        <?php
        if (TicketItem::findOne(['support_ticket_id' => $ticket_id])){
            $buttonText = "Ver item";
        }else{
            $buttonText = "Associar item";
        }
        echo Html::a($buttonText, ['item', 'ticket_id' => $ticket_id], ['class' => 'btn btn-success']);
        ?>

    </div>

    <?= $this->render('_form', [
        'client_id' => $client_id,
        'ticket_id' => $ticket_id,
        'dataProvider' => $dataProvider,
        'model' => $model,
    ]) ?>

</div>
