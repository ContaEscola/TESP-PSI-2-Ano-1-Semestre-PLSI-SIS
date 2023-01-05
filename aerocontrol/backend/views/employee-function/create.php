<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\EmployeeFunction $model */

$this->title = 'Criar Função de trabalhador';
$this->params['breadcrumbs'][] = ['label' => 'Funções do trabalhador', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-function-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
