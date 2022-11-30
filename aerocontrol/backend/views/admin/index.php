<?php

use common\models\Admin;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\AdminSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Administradores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-index">

    <p>
        <?= Html::a('Criar Administrador', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'summary' => '',
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'label' => 'ID',
                'value' => 'admin_id'
            ],
            [
                'label' => 'Username',
                'value' => function($model){
                    return $model->user->username;
                }
            ],
            [
                'label' => 'Nome',
                'value' => function($model){
                    return $model->user->first_name.' '.$model->user->last_name;
                }
            ],
            [
                'label' => 'Email',
                'value' => function($model){
                    return $model->user->email;
                }
            ],
            [
                'label' => 'Telefone',
                'value' => function($model){
                    return $model->user->phone;
                }
            ],
            [
                'label' => 'Género',
                'value' => function($model){
                    return $model->user->gender;
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Admin $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'admin_id' => $model->admin_id]);
                }
            ],
        ],
    ]);
    ?>


</div>
