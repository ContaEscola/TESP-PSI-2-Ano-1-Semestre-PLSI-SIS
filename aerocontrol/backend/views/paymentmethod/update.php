<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\PaymentMethod $model */

$this->title = 'Atualizar Método de Pagamento: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Métodos de Pagamento', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="payment-method-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
