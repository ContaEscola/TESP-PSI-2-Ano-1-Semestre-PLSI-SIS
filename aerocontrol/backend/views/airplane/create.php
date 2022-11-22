<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Airplane $model */

$this->title = 'Create Airplane';
$this->params['breadcrumbs'][] = ['label' => 'Airplanes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="airplane-create">

    <?= $this->render('_formcreate', [
        'model' => $model,
        'company' => $company,
        'company_airplanes' => $company_airplanes,
    ]) ?>

</div>
