<?php
/** @var \common\models\Flight $model */

use common\models\Airport;
use yii\helpers\Html;

?>
<li class="[ flight-result__wrapper ] [ bg-neutral-800 border-radius-1 ]">
    <p class="[ flight-company ] [ fs-300 letter-spacing-2 ]"><?=$model->airplane->company->name ?></p>
    <div class="[ flight-hours flight-result__hours ] [ justify-self-center-md ]">
        <p class="fs-300 letter-spacing-2 text-align-center fw-semi-bold "><?= Html::encode(Html::encode(Yii::$app->formatter->asDate($model->estimated_departure_date)))?></p>
        <div class="flight-trip">
            <p class="[ flight-trip__departure-time ] [ fs-300 fw-medium letter-spacing-2 text-align-right ]"><?= Html::encode(Yii::$app->formatter->asTime($model->estimated_departure_date)) ?></p>
            <p class="[ flight-trip__departure-city ] [ fs-300 fw-light letter-spacing-2 text-align-right ]"><?= Html::encode($model->originAirport->name) ?></p>

            <div class="[ flight-trip__icon ] [ align-self-center ]">
                <span aria-hidden="true">
                    <svg class="icon">
                        <use xlink:href="../images/flight-result-trip.svg#flight-result-trip"></use>
                    </svg>
                </span>
            </div>
            <p class="[ flight-trip__arrival-time ] [ fs-300 fw-medium letter-spacing-2 ]"><?= Html::encode(Yii::$app->formatter->asTime($model->estimated_arrival_date))?></p>
            <p class="[ flight-trip__arrival-city ] [ fs-300 fw-light letter-spacing-2 ]"><?= Html::encode($model->arrivalAirport->name)?></p>
        </div>
    </div>

    <div class="[ flight-result__details ] [ flow text-align-right ]" data-flow-space="very-small">
        <p class="fs-300 letter-spacing-2">Lugares disponíveis: <span class="fw-semi-bold"><?= Html::encode($model->passengers_left)?></span>
        </p>
        <div class="flow" data-flow-space="extra-small">
            <?php if ($model->discount_percentage !== 0):?>
            <p class="fs-300 italic text-error"><s><?= Html::encode($model->price - ($model->discount_percentage / 100 * $model->price)) ?>€</s></p>
            <?php endif;?>
            <p class="fs-300 fw-bold letter-spacing-2"><?= Html::encode($model->price) ?>€</p>
        </div>

    </div>
    <?= Html::a('Reservar', ['flight-ticket/create', 'id' => $model->id], ['class' => '[ flight-result__book button ] [ justify-self-end ]', 'data-type'=>'secondary']) ?>

    <a href="" class="[ flight-result__book button ] [ justify-self-end ]" data-type="secondary">Reservar</a>
</li>