<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SupportTicket $model */
/** @var int $ticket_id */
/** @var int $client_id */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Mensagem de Suporte';
$this->params['breadcrumbs'][] = ['label' => 'Tickets de Suporte', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="support-ticket-create">

    <?= $this->render('_form', [
        'client_id' => $client_id,
        'ticket_id' => $ticket_id,
        'dataProvider' => $dataProvider,
        'model' => $model,
    ]) ?>

</div>
