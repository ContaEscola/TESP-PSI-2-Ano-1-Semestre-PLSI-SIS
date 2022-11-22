<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Employee $model */

$this->title = 'Atualizar Trabalhador: ' . $model->user->first_name . " " . $model->user->last_name;
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->employee_id, 'url' => ['view', 'employee_id' => $model->employee_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="employee-update">
    <?= $this->render('_formupdate', [
        'model' => $model,
        'functions' =>$functions,
    ]) ?>

</div>
