<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SupportTicket $model */
/** @var int $ticket_id */

$this->title = 'Mensagem de Suporte';
$this->params['breadcrumbs'][] = ['label' => 'Tickets de Suporte', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="support-ticket-create">

    <?= $this->render('_form', [
        'ticket_id' => $ticket_id,
        'model' => $model,
    ]) ?>

</div>
