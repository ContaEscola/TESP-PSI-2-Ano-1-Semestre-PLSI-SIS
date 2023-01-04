<?php
/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProviderGo */
/** @var yii\data\ActiveDataProvider $dataProviderBack */
/** @var \frontend\models\FlightForm $model */
/** @var \common\models\Airport[] $airports */
/** @var bool $tryAgain */

use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = "Voos";
?>

<div class="container" data-type="small-md">
    <section class="padding-block-700">
        <h1 class="fs-500 fw-semi-bold text-align-center">Reserve agora o seu voo</h1>
        <?= $this->render('_form', [
            'airports' => $airports,
            'model' => $model
        ]) ?>
    </section>
    <div class="divider"></div>
    <section class="padding-block-700">

        <?php       //SE IDA E DATA PROVIDER MAL -> ERRO     OU      SE IDA/VOLTA E DATAPROVIDERS MAL -> ERRO
        if (!$model->two_way_trip && !(isset($dataProviderGo) && $dataProviderGo->totalCount > 0) ||
         $model->two_way_trip && !(isset($dataProviderGo) && $dataProviderGo->totalCount > 0 && isset($dataProviderBack) && $dataProviderBack->totalCount > 0)) {
            if (!$tryAgain) {
                echo '<h2 class="fs-500 fw-semi-bold text-align-center margin-top-400">' . $model->destiny . ' - ' . $model->origin . '</h2>';
                echo $this->render('search-more-flights', [
                    'model' => $model,
                ]);
            } else {
                echo $this->render('no-flights', [
                    'model' => $model,
                ]);
            }
        } else {
            // ESCREVE A LISTVIEW DE IDA, PORQUE NÃO HOUVE ERROS
            echo ListView::widget([
                'dataProvider' => $dataProviderGo,
                'summary' => '<h2 class="fs-500 fw-semi-bold text-align-center">'. $model->origin . ' - ' . $model->destiny .'</h2>
                            <p class="fs-400 fw-semi-bold text-align-center margin-top-50">'. $dataProviderGo->getTotalCount() .' Resultados encontrados!</p>',
                'options' => [
                    'tag' => 'ul',
                    'class' => 'margin-top-400 flow',
                    'role' => 'list',
                    'data-flow-space' => 'medium'
                ],
                'emptyText' => "",
                'itemView' => '_flight',
            ]);
            // SE FOR IDA/VOLTA, ESCREVE A LISTVIEW DE VOLTA
            if ($model->two_way_trip){
                echo ListView::widget([
                    'dataProvider' => $dataProviderBack,
                    'summary' => '<h2 class="fs-500 fw-semi-bold text-align-center">'. $model->destiny . ' - ' . $model->origin .'</h2>
                    <p class="fs-400 fw-semi-bold text-align-center margin-top-50">'. $dataProviderBack->getTotalCount() .' Resultados encontrados!</p>',
                    'options' => [
                        'tag' => 'ul',
                        'class' => 'margin-top-400 flow',
                        'role' => 'list',
                        'data-flow-space' => 'medium'
                    ],
                    'emptyText' => "",
                    'itemView' => '_flight',
                ]);
            }
        }?>

    </section>
</div>