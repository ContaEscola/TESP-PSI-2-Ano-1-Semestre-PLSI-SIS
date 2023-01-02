<?php

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

use yii\widgets\ListView;

$this->title = "Meus Bilhetes";
$this->registerJsFile('@web/js/flight-tickets.js', [
    'type' => 'module',
]);
?>

<section class="container padding-block-700" data-type="small-md">
    <h1 class="fs-600 fw-bold text-align-center">Meus Bilhetes</h1>
    <div class="margin-top-400">

        <ul role="list" class="flow" data-flow-space="medium">
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'summary' => '',
                'emptyText' => "<p class='fw-medium text-align-center'> Você ainda não comprou nenhum bilhete!</p>",
                'itemView' => '_ticket',
            ]); ?>
        </ul>
    </div>

</section>