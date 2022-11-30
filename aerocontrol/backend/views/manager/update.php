<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Manager $model */

$this->title = 'Atualizar Gerente: ' . $model->user->first_name . " " . $model->user->last_name;
$this->params['breadcrumbs'][] = ['label' => 'Gerentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->manager_id, 'url' => ['view', 'manager_id' => $model->manager_id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="manager-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
