<?php

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = "Restaurantes";
?>
<section class="padding-block-700">
    <div class="container">
        <h1 class="fs-600 fw-bold text-align-center">Restaurantes</h1>
        <?=
        ListView::widget([
            'dataProvider' => $dataProvider,
            'summary' => '',
            'options' => [
                'tag' => 'ul',
                'class' => 'margin-top-500 d-grid grid-auto-fit',
                'role' => 'list',
                'data-item-size' => 'medium',
            ],
            'emptyText' => "Ainda não existem restaurantes",
            'emptyTextOptions' => [
                'tag' => 'p',
                'class' => 'fw-medium'
            ],
            'itemView' => '_restaurant',
        ]);
        ?>
        <!-- <ul role="list" class="margin-top-500 d-grid grid-auto-fit" data-item-size="medium">
            <li>
                <a href="#" class="[ card ]  [ d-block stacked-grid text-decoration-none ]">
                    <img class="card__img" src="../images/restaurants/Burger King_15-12-2022_20-49.png" alt="Restaurant logo">
                    <div class="card-body__wrapper  d-flex flex-flow-row align-items-end">
                        <div class="[ card__body ] [ text-white width-100 padding-100 ]">
                            <p class="fs-300 fw-bold text-break">Burger King</p>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a href="#" class="[ card ]  [ d-block stacked-grid text-decoration-none ]">
                    <img class="card__img" src="../images/restaurants/Delta_15-12-2022_20-50.png" alt="Restaurant logo">
                    <div class="card-body__wrapper  d-flex flex-flow-row align-items-end">
                        <div class="[ card__body ] [ text-white width-100 padding-100 ]">
                            <p class="fs-300 fw-bold text-break">Delta</p>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a href="#" class="[ card ]  [ d-block stacked-grid text-decoration-none ]">
                    <img class="card__img" src="../images/restaurants/KFC_15-12-2022_20-52.png" alt="Restaurant logo">
                    <div class="card-body__wrapper  d-flex flex-flow-row align-items-end">
                        <div class="[ card__body ] [ text-white width-100 padding-100 ]">
                            <p class="fs-300 fw-bold text-break">KFC</p>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a href="#" class="[ card ]  [ d-block stacked-grid text-decoration-none ]">
                    <img class="card__img" src="../images/restaurants/McDonalds_15-12-2022_20-53.png" alt="Restaurant logo">
                    <div class="card-body__wrapper  d-flex flex-flow-row align-items-end">
                        <div class="[ card__body ] [ text-white width-100 padding-100 ]">
                            <p class="fs-300 fw-bold text-break">McDonalds</p>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a href="#" class="[ card ]  [ d-block stacked-grid text-decoration-none ]">
                    <img class="card__img" src="../images/restaurants/Starbucks_15-12-2022_20-55.png" alt="Restaurant logo">
                    <div class="card-body__wrapper  d-flex flex-flow-row align-items-end">
                        <div class="[ card__body ] [ text-white width-100 padding-100 ]">
                            <p class="fs-300 fw-bold text-break">Startbucks</p>
                        </div>
                    </div>
                </a>
            </li>
        </ul> -->
    </div>
</section>