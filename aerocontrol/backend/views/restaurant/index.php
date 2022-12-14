<?php

use common\models\Restaurant;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\RestaurantSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Restaurantes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="restaurant-index">


    <p>
        <?= Html::a('Criar Restaurante', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <table class="table">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Nº Telemóvel</th>
            <th>Horário de Abertura</th>
            <th>Horário de Fecho</th>
            <th>Website</th>
            <th>Ações</th>
        </tr>
        <?php
        foreach ($restaurants as $restaurant) : ?>
            <tr>
                <th scope="row"><?= $restaurant->id ?></th>
                <td><?= $restaurant->name ?></td>
                <td><?= $restaurant->description ?></td>
                <td><?= $restaurant->phone ?></td>
                <td><?= $restaurant->open_time ?></td>
                <td><?= $restaurant->close_time ?></td>
                <td><?= $restaurant->website ?></td>
                <td>
                    <a class="btn btn-primary" href="<?= Url::to(['restaurant/view', 'id' => $restaurant->id]) ?>">Visualizar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>


</div>
