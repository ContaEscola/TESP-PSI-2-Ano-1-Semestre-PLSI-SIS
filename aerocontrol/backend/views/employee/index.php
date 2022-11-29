<?php

use common\models\Employee;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var common\models\EmployeeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Trabalhadores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-index">
    <p>
        <?= Html::a('Criar novo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'summary' => '',
        'dataProvider' => $dataProvider,
        'columns' => [
            'employee_id',
            [
                'label' => 'Nº Empregado',
                'value' => function($model){
                    return $model->num_emp;
                }
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
                'label' => 'Nº Contribuinte',
                'value' => function($model){
                    return $model->tin;
                }
            ],
            [
                'label' => 'Função',
                'value' => function($model){
                    return $model->function->name;
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Employee $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'employee_id' => $model->employee_id]);
                }
            ],
        ],
    ]);
    ?>

</div>