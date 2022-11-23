<?php

use common\models\Employee;
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

    <table class="table">
        <tr>
            <th>ID</th>
            <th>NºEmpregado</th>
            <th>Username</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Tin</th>
            <th>Função</th>
            <th>Ações</th>
        </tr>
        <?php
        foreach ($employees as $employee) : ?>
            <tr>
                <th scope="row"><?= $employee->user->id ?></th>
                <td><?= $employee->num_emp ?></td>
                <td><?= $employee->user->username ?></td>
                <td><?= $employee->user->first_name . " " . $employee->user->last_name ?></td>
                <td><?= $employee->user->email ?></td>
                <td><?= $employee->user->phone ?></td>
                <td><?= $employee->tin ?></td>
                <td><?= $employee->function->name ?></td>
                <td>
                    <a class="btn btn-primary" href="<?= Url::to(['employee/view', 'employee_id' => $employee->user->id]) ?>">Visualizar</a>
                    <?= Html::a('Delete', ['delete', 'employee_id' => $employee->employee_id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>