<?php

use common\models\Company;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\CompanySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Companhias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">
    <p>
        <?= Html::a('Criar nova', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <table class="table">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Estado</th>
            <th>Ações</th>
        </tr>
        <?php
        foreach ($companies as $company) : ?>
            <tr>
                <th scope="row"><?= $company->id ?></th>
                <td><?= $company->name ?></td>
                <td>
                    <?php
                    if($company->state == 0){
                        echo "Inativo";
                    } else{
                        echo "Ativo";
                    }
                    ?></td>
                <td>
                    <a class="btn btn-primary" href="<?= Url::to(['company/view', 'id' => $company->id]) ?>">Visualizar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>