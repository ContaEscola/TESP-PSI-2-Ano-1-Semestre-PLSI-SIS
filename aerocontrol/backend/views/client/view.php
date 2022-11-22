<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Client $model */

$this->title = $model->user->first_name . " " . $model->user->last_name;
$this->params['breadcrumbs'][] = ['label' => 'Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="client-view">

    <p>
        <?= Html::a('Atualizar', ['update', 'client_id' => $model->client_id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'ID',
                'value' => $model->client_id,
            ],
            [
                'label' => 'Username',
                'value' => $model->user->username,
            ],
            [
                'label' => 'Nome',
                'value' => $model->user->first_name." ".$model->user->last_name,
            ],
            [
                'label' => 'Email',
                'value' => $model->user->email,
            ],
            [
                'label' => 'Telefone',
                'value' => $model->user->phone_country_code." ".$model->user->phone,
            ],
            [
                'label' => 'Género',
                'value' => $model->user->gender,
            ],
            [
                'label' => 'País',
                'value' => $model->user->country,
            ],
            [
                'label' => 'Cidade',
                'value' => $model->user->city,
            ],
            [
                'label' => 'Data de Nascimento',
                'value' => $model->user->birthdate,
            ],
        ],
    ]) ?>

</div>
