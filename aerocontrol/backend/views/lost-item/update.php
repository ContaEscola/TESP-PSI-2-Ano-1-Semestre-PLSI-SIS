<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\LostItem $model */

$this->title = 'Atualizar item perdido e achado';
$this->params['breadcrumbs'][] = ['label' => 'Perdidos e achados', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="lost-item-update">

    <?= $this->render('_form-update', [
        'model' => $model,
    ]) ?>

</div>
