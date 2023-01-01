<?php
/** @var \common\models\FlightTicket $model */

use yii\helpers\Html;
use yii\helpers\Url;

?>
<dialog id="flight-ticket-modal" class="[ flight-ticket-modal ] [ padding-300 text-black-400 ]"
        data-modal>
    <button class="[ modal__close-btn ] [ d-block push-to-right ]" data-close-modal><span
                class="visually-hidden">Close
                            modal</span>
        <img src="<?= Url::to('@web/images/close-icon.svg') ?>" alt="" aria-hidden="true"></button>

    <section class="margin-top-400 d-flex justify-content-space-between">
        <button class="button" data-type="error">Cancelar</button>
        <button class="button">Check-in</button>

    </section>

    <section class="margin-top-600 flow fs-300">
        <div class="d-flex justify-content-space-between">
            <p>Data: <span class="fw-semi-bold letter-spacing-2" flight-ticket-modal-date></span></p>
            <p>Estado: <span class="fw-semi-bold letter-spacing-2" flight-ticket-modal-state></span>
            </p>
        </div>

        <div class="d-flex justify-content-space-between">
            <p>Origem: <span class="fw-medium" flight-ticket-modal-departure-city></span></p>
            <p>Destino: <span class="fw-medium" flight-ticket-modal-arrival-city></span></p>
        </div>
        <div class="d-flex justify-content-space-between">
            <p>Partida: <span flight-ticket-modal-departure-time></span></p>
            <p>Chegada: <span flight-ticket-modal-arrival-time></span></p>
        </div>
        <div class="d-flex justify-content-space-between">
            <p>Distãncia: <span class="letter-spacing-2 uppercase" flight-ticket-modal-distance></span>
            </p>
            <p>Terminal: <span class="fw-semi-bold letter-spacing-2"
                               flight-ticket-modal-terminal></span></p>
        </div>
        <div class="d-flex justify-content-space-between">
            <p>Data de Compra: <span class="fw-semi-bold letter-spacing-2"
                                     flight-ticket-modal-bought-date></span></p>
            <div class="d-flex">
                <p><s class="text-black-200 italic" flight-ticket-modal-discount></s></p>
                <p class="fw-semi-bold" flight-ticket-modal-price></p>
            </div>
        </div>
    </section>
    <section class="margin-top-400">
        <h2 class="fs-500 fw-semi-bold text-align-center">Passageiros</h2>
        <ul role="list" class="d-grid grid-auto-fit margin-top-300" flight-ticket-modal-passengers-list>
            <template id="flight-ticket-modal-passenger-item-template">
                <li>
                    <h3 class="fs-400 fw-medium">Passageiro <span class="letter-spacing-3"
                                                                  flight-ticket-modal-passenger-number></span>
                    </h3>
                    <div class="margin-top-100 flow-sm even-columns gap-0">
                        <div>
                            <p class="fs-350">Nome:</p>
                            <p class="fs-300 fw-light margin-top-50" flight-ticket-modal-passenger-name>
                            </p>
                        </div>
                        <div class="d-flex gap-5">
                            <div>
                                <p class="fs-350">Género:</p>
                                <p class="fs-300 fw-light margin-top-50"
                                   flight-ticket-modal-passenger-gender></p>
                            </div>
                            <div>
                                <p class="fs-350">Lugar:</p>
                                <p class="fs-300 fw-light margin-top-50"
                                   flight-ticket-modal-passenger-seat></p>
                            </div>
                        </div>
                    </div>
                </li>
            </template>
        </ul>
    </section>
</dialog>

<li style="margin-bottom: 15px">
    <article class="[ flight-ticket__item ] [ bg-primary border-radius-1 ]" flight-ticket>
        <p class="[ flight-date ] [ fs-350 ]">Data:
            <span class="fw-semi-bold letter-spacing-2" flight-ticket-date><?= Html::encode(date('d-m-Y',strtotime($model->flight->estimated_departure_date))) ?></span>
        </p>
        <p class="[ flight-state ] [ fs-350 margin-top-50-sm ]">Estado:
            <span class="fw-semi-bold letter-spacing-2" flight-ticket-state><?= Html::encode($model->flight->state) ?></span>
        </p>

        <div class="[ flight-hours ] [ justify-self-end-sm justify-self-start-md ]">
            <div class="flight-trip">
                <p class="[ flight-trip__departure-time ] [ fs-350 fw-medium letter-spacing-2 text-align-right ]" flight-ticket-departure-time>
                    <?= Html::encode(date('H:i',strtotime($model->flight->estimated_departure_date))) ?>
                </p>
                <p class="[ flight-trip__departure-city ] [ fs-350 fw-light letter-spacing-2 text-align-right ]" flight-ticket-departure-city>
                    <?= Html::encode($model->flight->originAirport->city) ?>
                </p>

                <div class="[ flight-trip__icon ] [ align-self-center ]">
                    <span aria-hidden="true">
                        <svg class="icon">
                            <use xlink:href="../images/flight-result-trip.svg#flight-result-trip">
                            </use>
                        </svg>
                    </span>
                </div>

                <p class="[ flight-trip__arrival-time ] [ fs-350 fw-medium letter-spacing-2 ]" flight-ticket-arrival-time>
                    <?= Html::encode(date('H:i',strtotime($model->flight->estimated_arrival_date))) ?>
                </p>
                <p class="[ flight-trip__arrival-city ] [ fs-350 fw-light letter-spacing-2 ]" flight-ticket-arrival-city>
                    <?= Html::encode($model->flight->arrivalAirport->city) ?>
                </p>

            </div>
        </div>

        <button class="[ flight-ticket__see-more-details button ] [ margin-top-200-sm height-min-content ]"
                aria-expanded="false" aria-controls="more-details" data-type>Ver mais detalhes</button>

        <div class="flight-more-details__wrapper" id="more-details">
            <section class="[ flight-ticket__more-details ] [ width-100 margin-top-200 ]">
                <p class="[ flight-bought-date ] [ fs-350 ]">Data de Compra:
                    <span class="fw-semi-bold letter-spacing-2" flight-ticket-bought-date><?= Html::encode(date('d-m-Y',strtotime($model->purchase_date))) ?></span>
                </p>
                <p class="[ flight-distance ] [ fs-350 ]">Distância:
                    <span class="letter-spacing-2 uppercase" flight-ticket-distance><?= Html::encode($model->flight->distance) ?>km</span>
                </p>
                <div class="[ flight-ticket__grouped-details ]">
                    <p class="[ flight-company ] [ fs-350 ]" flight-ticket-company><?= Html::encode($model->flight->airplane->company->name) ?></p>
                    <p class="[ flight-terminal ] [ fs-350 ]">Terminal:
                        <span class="fw-semi-bold letter-spacing-2" flight-ticket-terminal><?= Html::encode($model->flight->terminal) ?></span>
                    </p>

                    <div class="[ flight-price ] [ fs-350 d-flex push-to-right ]">
                        <p><s class="text-black-200 italic" flight-ticket-discount></s><?= Html::encode($model->flight->price) ?>€</p>
                        <p class="fw-semi-bold" flight-ticket-price><?= Html::encode($model->price) ?>€</p>
                    </div>
                </div>
                <?php if ($model->passengers) :?>
                    <section class="flight-passengers">
                        <h2 class="fs-500 fw-semi-bold">Passageiros</h2>
                        <table class="[ flight-passengers-table ] [ margin-top-100 fs-350 ]">
                            <thead>
                            <tr>
                                <th class="fw-medium">Nome:</th>
                                <th class="fw-medium">Género:</th>
                                <th class="fw-medium">Lugar:</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($model->passengers as $passenger):?>
                                <tr>
                                    <td flight-ticket-passenger-name><?= $passenger->name ?></td>
                                    <td flight-ticket-passenger-gender><?= $passenger->gender ?></td>
                                    <td flight-ticket-passenger-seat><?= $passenger->seat ?></td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </section>
                <?php endif;?>
                <div
                    class="[ flight-ticket-actions ] [ d-flex justify-content-space-between align-self-end ]">
                    <?php if($model->checkin == 0){
                        echo Html::a('Cancelar',['flightticket/delete','flight_ticket_id'=>$model->flight_ticket_id],['data-method' => 'post','class'=>'button','data-type'=>'error']);
                        echo Html::a('Check-in',['flightticket/checkin','flight_ticket_id'=>$model->flight_ticket_id],['data-method' => 'post', 'class'=>'button']);
                    } ?>
                </div>

            </section>
        </div>
    </article>
</li>