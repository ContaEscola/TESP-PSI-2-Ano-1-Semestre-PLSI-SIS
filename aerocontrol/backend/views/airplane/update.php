<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Airplane $model */

$this->title = 'Atualizar Avião: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Airplanes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="airplane-update">

    <?= $this->render('_formupdate', [
        'model' => $model,
        'company_airplanes' => $company_airplanes,
    ]) ?>

</div>
