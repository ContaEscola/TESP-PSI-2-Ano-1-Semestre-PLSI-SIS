<?php

use common\models\Airport;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\AirportSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Aeroportos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="airport-index">
    <p>
        <?= Html::a('Criar aeroporto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <table class="table">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Pais</th>
            <th>Cidade</th>
            <th>Website</th>
            <th>Ações</th>
        </tr>
        <?php
        foreach ($airports as $airport) : ?>
            <tr>
                <th scope="row"><?= $airport->id ?></th>
                <td><?= $airport->name ?></td>
                <td><?= $airport->country ?></td>
                <td><?= $airport->city ?></td>
                <td><?= $airport->website ?></td>
                <td>
                    <a class="btn btn-primary" href="<?= Url::to(['airport/view', 'id' => $airport->id]) ?>">Visualizar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>


</div>
