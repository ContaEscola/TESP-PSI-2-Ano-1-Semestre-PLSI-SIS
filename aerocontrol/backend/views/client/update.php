<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Client $model */

$this->title = 'Atualizar Cliente: ' . $model->user->first_name . " " . $model->user->last_name;
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->client_id, 'url' => ['view', 'client_id' => $model->client_id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="client-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>