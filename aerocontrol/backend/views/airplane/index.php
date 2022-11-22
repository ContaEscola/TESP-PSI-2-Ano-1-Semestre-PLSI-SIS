<?php

use common\models\Airplane;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\AirplaneSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Airplanes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="airplane-index">
    <p>
        <?= Html::a('Criar avião', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <table class="table">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Capacidade</th>
            <th>Estado</th>
            <th>Companhia</th>
            <th>Ações</th>
        </tr>
        <?php
        foreach ($airplanes as $airplane):?>
            <tr>
                <th scope="row"><?= $airplane->id?></th>
                <td><?= $airplane->name?></td>
                <td><?= $airplane->capacity?></td>
                <td><?= $airplane->state?></td>
                <td><?= $airplane->company->id?></td>
                <td>
                    <a class="btn btn-primary" href="<?=Url::to(['airplane/view','id'=>$airplane->id])?>">Visualizar</a>
                    <?= Html::a('Delete', ['delete', 'id' => $airplane->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </td>
            </tr>
        <?php endforeach;?>
    </table>


</div>
