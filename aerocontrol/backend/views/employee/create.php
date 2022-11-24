<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Employee $model */

$this->title = 'Criar Trabalhador';
$this->params['breadcrumbs'][] = ['label' => 'Trabalhadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-create">

    <?= $this->render('_form', [
        'model' => $model,
        'possibleGenders' => $possibleGenders,
        'possibleQualifications' => $possibleQualifications,
        'possibleFunctions' => $possibleFunctions
    ]) ?>

</div>