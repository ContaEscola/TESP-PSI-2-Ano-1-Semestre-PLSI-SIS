<?php

use yii\helpers\Url;

$this->title = 'Starter Page';
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => '150',
                'text' => 'Voos',
                'icon' => 'fas fa-plane-departure',
                'linkUrl'=>Url::to(["/flight/index"])
            ]) ?>
        </div>
        <div class="col">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => '150',
                'text' => 'Aeroportos',
                'icon' => 'fas fa-plane-arrival',
                'linkUrl'=>Url::to(["/airport/index"])
            ]) ?>
        </div>
        <div class="col">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => '150',
                'text' => 'Aviões',
                'icon' => 'fas fa-plane',
                'linkUrl'=>Url::to(["/airplane/index"])
            ]) ?>
        </div>
        <div class="col">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => '150',
                'text' => 'Companhias',
                'icon' => 'fas fa-building',
                'linkUrl'=>Url::to(["/company/index"])
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => '150',
                'text' => 'Trabalhadores',
                'icon' => 'fas fa-user',
                'linkUrl'=>Url::to(["/employee/index"])
            ]) ?>
        </div>
        <div class="col">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => '150',
                'text' => 'Clientes',
                'icon' => 'fas fa-user',
                'linkUrl'=>Url::to(["/client/index"])
            ]) ?>
        </div>
        <div class="col">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => '150',
                'text' => 'Perdidos e achados',
                'icon' => 'fas fa-suitcase-rolling',
                'linkUrl'=>Url::to(["/lostitem/index"])
            ]) ?>
        </div>
        <div class="col">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => '150',
                'text' => 'Suporte ao cliente',
                'icon' => 'fas fa-envelope',
                'linkUrl'=>Url::to(["/supportticket/index"])
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => '150',
                'text' => 'Métodos de pagamento',

                'icon' => 'fas fa-solid fa-credit-card',
                'linkUrl'=>Url::to(["/paymentmethod/index"])
            ]) ?>
        </div>
        <div class="col">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => '150',
                'text' => 'Restaurante',
                'icon' => 'fas fa-utensils',
                'linkUrl'=>Url::to(["/restaurant/index"])
            ]) ?>
        </div>
        <div class="col">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => '150',
                'text' => 'Lojas',
                'icon' => 'fas fa-shopping-cart',
                'linkUrl'=>Url::to(["/store/index"])
            ]) ?>
        </div>
        <div class="col">
            <?= \hail812\adminlte\widgets\SmallBox::widget([
                'title' => '150',
                'text' => 'Server Log',
                'icon' => 'fas fa-info',
                'linkUrl'=>Url::to([""])
            ]) ?>
        </div>
    </div>
</div>
