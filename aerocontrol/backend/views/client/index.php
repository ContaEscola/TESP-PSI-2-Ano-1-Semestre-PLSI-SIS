<?php

use common\models\Client;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\ClientSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-index">

    <table class="table">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Género</th>
            <th>Ações</th>
        </tr>
        <?php
        foreach ($clients as $client):?>
            <tr>
                <th scope="row"><?= $client->user->id?></th>
                <td><?= $client->user->username?></td>
                <td><?= $client->user->first_name." ".$client->user->last_name?></td>
                <td><?= $client->user->email?></td>
                <td><?= $client->user->phone?></td>
                <td><?= $client->user->gender?></td>
                <td>
                    <a class="btn btn-primary" href="<?=Url::to(['client/view','client_id'=>$client->user->id])?>">Visualizar</a>
                </td>
            </tr>
        <?php endforeach;?>
    </table>

</div>
