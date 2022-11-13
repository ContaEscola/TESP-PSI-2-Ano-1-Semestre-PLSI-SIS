<?php

use common\models\Employee;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var common\models\EmployeeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Employees';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Employee', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?php /*= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model->employee_id), ['view', 'employee_id' => $model->employee_id]);
        },
    ]) */?>

    <table class="table">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Primeiro Nome</th>
            <th>Ultimo Nome</th>
            <th>Género</th>
            <th>País</th>
            <th>Cidade</th>
            <th>Código Postal</th>
            <th>Rua</th>
            <th>Data de Nascimento</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Tin</th>
            <th>NºEmpregado</th>
            <th>SSN</th>
            <th>Iban</th>
            <th>Qualificações</th>
            <th>Função</th>
        </tr>
    <?php
    foreach ($employees as $employee):?>
        <tr>
            <th scope="row"><?= $employee->user->id?></th>
            <td><?= $employee->user->username?></td>
            <td><?= $employee->user->first_name?></td>
            <td><?= $employee->user->last_name?></td>
            <td><?= $employee->user->gender?></td>
            <td><?= $employee->user->country?></td>
            <td><?= $employee->user->city?></td>
            <td><?= $employee->zip_code?></td>
            <td><?= $employee->street?></td>
            <td><?= $employee->user->birthdate?></td>
            <td><?= $employee->user->email?></td>
            <td><?= $employee->user->phone?></td>
            <td><?= $employee->street?></td>
            <td><?= $employee->num_emp?></td>
            <td><?= $employee->ssn?></td>
            <td><?= $employee->iban?></td>
            <td><?= $employee->qualifications?></td>
            <td><?= $employee->function->name?></td>
        </tr>
    <?php endforeach;?>
    </table>


</div>
