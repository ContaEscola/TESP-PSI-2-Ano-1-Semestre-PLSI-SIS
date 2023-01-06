<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\SupportTicket $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Ticket de Suporte', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="support-ticket-view">

    <?php $form = ActiveForm::begin([
        'validateOnType' => true,
        'validationDelay' => 500,
    ]); ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'state',
            'client_id',
        ],
    ]) ?>

    <p>
        <?= Html::a('Enviar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php ActiveForm::end(); ?>
</div>
