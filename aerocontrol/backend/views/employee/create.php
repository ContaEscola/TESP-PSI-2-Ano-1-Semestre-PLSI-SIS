<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Employee $model */

$this->title = 'Criar trabalhador';
$this->params['breadcrumbs'][] = ['label' => 'Trabalhador', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-create">

    <?= $this->render('_formcreate', [
        'model' => $model,
        'user' => $user,
        'function' => $function,
        'functions' => $functions,
    ]) ?>

</div>