<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\LostItem $model */

$this->title = 'Criar item perdido e achado';
$this->params['breadcrumbs'][] = ['label' => 'Perdidos e achados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lost-item-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
