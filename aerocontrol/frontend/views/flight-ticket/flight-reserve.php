<?php

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var \frontend\models\FlightReserveForm $model */
/** @var int $numPassengers */
/** @var int $flightBackId */
/** @var int $flightGoId */

use common\models\PaymentMethod;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = "Reservar Voo";
$this->registerJsFile('@web/js/flight-reserve.js');
?>
<section class="padding-block-700">
    <div class="container" data-type="small-md">
        <?php $form = ActiveForm::begin([
            'action' => [
                'create',
                'numPassengers' => $numPassengers,
                'flightBackId' => $flightBackId,
                'flightGoId' => $flightGoId,
            ],
            'errorCssClass' => 'invalid',
            'requiredCssClass' => 'invalid',
            'successCssClass' => 'valid',
            'validateOnType' => true,
            'validationDelay' => 500,
        ]) ?>
            <section>
                <h1 class="fs-600 fw-bold text-align-center">Informações dos Passageiros</h1>
                <ul role="list" class="padding-300 box-shadow-1 margin-top-400 flow ]" data-flow-space="medium">
                    <?php for ($i = 0; $i < $numPassengers; $i++):?>
                        <li class="[ flight-reserve__passenger-info ] [ d-grid gap-2 ]">


                                <?= $form->field($model, 'name['.$i."]", [
                                    'template' => '<p class="fs-350 fw-medium grid-area-title align-self-center">Passageiro ' . ($i + 1) .'</p>{label}{input}{hint}{error}',
                                    'options' => [
                                        'class' => '[ form__group passenger-info__name ] [ d-grid row-gap-0 col-gap-2 ]',
                                    ],
                                    'errorOptions' => [
                                        'tag' => 'p',
                                        'class' => 'input__error grid-area-error-1 margin-top-50 text-break'
                                    ],
                                ])
                                    ->label(null, [
                                        'class' => '[ input__label ] [ grid-area-label-1 margin-bottom-50 ' . ($i!=0 ? ' visually-hidden-flight-reserve' : ' ') .' ]'
                                    ])
                                    ->textInput([
                                        'class' => '[ form__input ] [ grid-area-input-1 ]',
                                    ]) ?>


                            <div class="[ form__group passenger-info__gender-baggage ] [ d-grid row-gap-0 grid-area-form-group-1 ]">
                                <?= $form->field($model, 'gender', [
                                    'errorOptions' => [
                                        'tag' => 'p',
                                        'class' => 'input__error grid-area-error-1 margin-top-50 text-break'
                                    ],
                                    'options' => ['tag' => false],
                                ])
                                ->label(null, [
                                    'class' => '[ input__label ] [ grid-area-label-1 margin-bottom-50' . ($i!=0 ? ' visually-hidden-flight-reserve' : ' ') .' ]',
                                ])
                                ->dropDownList($model::POSSIBLE_GENDERS_FOR_DROPDOWN, [
                                'prompt' => '',
                                'class' => '[ form__input ] [ grid-area-select-1 ]'
                                ]) ?>

                                <?= $form->field($model, 'extra_baggage[' . $i . ']', [
                                    'options' => [
                                        'class' => '[ form__group ] [ grid-area-form-group-1 align-items-center ]',
                                    ],
                                    'errorOptions' => [
                                        'tag' => false,
                                    ]
                                ])->checkbox([
                                    'template' => '
                                        <label for="extra-baggage" class="[ input__label ] [ margin-bottom-50 ' . ($i != 0 ? 'visually-hidden-flight-reserve' : ' ') .' ]">{label}</label>
                                        <div class="d-flex height-100">{input}</div>{error}{hint}',
                                    'class' => '[ form__input ] [ justify-self-center ]',
                                ]) ?>
                            </div>
                        </li>
                    <?php endfor;?>
                </ul>
            </section>
            <section class="margin-top-500 flow" data-flow-space="large">
                <h2 class="fs-600 fw-bold text-align-center">Pagamento</h2>
                   <?= $form->field($model, 'payment_method', [
                        'errorOptions' => [
                            'tag' => false,
                        ]
                    ])
                    ->radioList(
                        [
                            $model::CREDIT_CARD => 'Cartão de crédito',
                            $model::DEBIT_CARD => 'Cartão de débito',
                            $model::MBWAY => 'MBWay',
                            $model::MULTIBANCO => 'Multibanco',
                            $model::PAYPAL => 'Paypal'
                        ],
                        [
                            'item' => function ($index, $label, $name, $checked, $value) use ($model) {

                                $paymentMethod = PaymentMethod::find()->where(['name' => $label])->one();
                                $return = '<label class="[ payment-method-button ] [ radio-button button '. (!$paymentMethod->state?'disabled':'') .' ]" 
                                    data-active="' . ($checked ? 'true" ' : 'false" ') . (!$paymentMethod->state?
                                    'data-toggle="tooltip" data-tooltip-title="Este método de pagamento não está disponível" tabindex="0" ' : '') .
                                    'data-payment-method="' . $value . '"';
                                switch ($value) {
                                    case $model::CREDIT_CARD:
                                        $return .= 'data-type="secondary-outline"';
                                        $image = Url::to('@web/images/payment-methods-icon.svg#credit-card-icon');
                                        break;
                                    case $model::DEBIT_CARD:
                                        $return .= 'data-type="secondary-outline"';
                                        $image = Url::to('@web/images/payment-methods-icon.svg#debit-card-icon');
                                        break;
                                    case $model::MBWAY:
                                        $image = Url::to('@web/images/payment-methods-icon.svg#mbway-icon');
                                        break;
                                    case $model::MULTIBANCO:
                                        $image = Url::to('@web/images/payment-methods-icon.svg#multibanco-icon');
                                        break;
                                    case $model::PAYPAL:
                                        $image = Url::to('@web/images/payment-methods-icon.svg#paypal-logo-icon');
                                        break;
                                }
                                $return .= '">';

                                $return .= '<input type="radio" name="' . $name . '" value="' . $value . '" ' . ($checked ? 'checked' : "") . (!$paymentMethod->state?'disabled ' : '').' >';
                                $return .= '<span aria-hidden="true">';
                                if ($value !== $model::PAYPAL) { // Se não for paypal
                                    $return .= '<svg class="icon">
                                                    <use xlink:href="' . $image . '"></use>
                                                </svg>';
                                } else {
                                    $return .= '<svg id="paypal-logo-icon" class="icon" viewBox="0 0 14 18" xmlns="http://www.w3.org/2000/svg">
                                                    <path id="path3" d="M11.9792 4.46694C12.0185 2.42229 10.3335 0.853714 8.01648 0.853714H3.22392C3.11224 0.853661 3.00421 0.893527 2.91929 0.966129C2.83437 1.03873 2.77814 1.1393 2.76074 1.24971L0.840484 13.2594C0.831892 13.3138 0.835187 13.3694 0.850141 13.4225C0.865094 13.4755 0.891352 13.5247 0.927105 13.5665C0.962859 13.6084 1.00726 13.6421 1.05725 13.6652C1.10724 13.6882 1.16163 13.7002 1.21668 13.7002H4.05596L3.61223 16.481C3.60364 16.5354 3.60693 16.5911 3.62189 16.6441C3.63684 16.6971 3.6631 16.7463 3.69885 16.7882C3.7346 16.8301 3.779 16.8637 3.82899 16.8868C3.87898 16.9099 3.93338 16.9218 3.98842 16.9218H6.30139C6.41297 16.9218 6.51243 16.8818 6.59758 16.8094C6.68199 16.7367 6.69594 16.6364 6.71356 16.5258L7.39255 12.5276C7.4098 12.4174 7.46595 12.2742 7.55073 12.2014C7.63552 12.1287 7.70965 12.089 7.8216 12.089H9.23683C11.5061 12.089 13.4311 10.4745 13.7831 8.22931C14.0323 6.63576 13.3497 5.18547 11.9792 4.46657V4.46694Z" />
                                                    <path id="path2" d="M4.67035 9.2711L3.9631 13.7593L3.519 16.5747C3.51046 16.6291 3.51381 16.6847 3.52881 16.7378C3.54381 16.7908 3.57011 16.8399 3.6059 16.8817C3.64169 16.9236 3.68611 16.9572 3.73612 16.9802C3.78612 17.0033 3.84052 17.0152 3.89556 17.0151H6.3436C6.45517 17.0151 6.56307 16.9752 6.64785 16.9026C6.73263 16.83 6.78873 16.7295 6.80604 16.6191L7.45127 12.5273C7.46866 12.4169 7.52483 12.3164 7.60967 12.2438C7.69452 12.1712 7.80246 12.1313 7.91408 12.1313H9.355C11.6243 12.1313 13.5493 10.4745 13.9017 8.2293C14.1512 6.63575 13.3497 5.18547 11.9792 4.46657C11.9755 4.63628 11.9609 4.80563 11.9348 4.97351C11.5828 7.218 9.65706 8.8751 7.3885 8.8751H5.13316C5.02151 8.87522 4.91356 8.91521 4.82872 8.98786C4.74389 9.06052 4.68773 9.16108 4.67035 9.27147" />
                                                    <path d="M3.96273 13.7593H1.11465C1.05961 13.7593 1.00523 13.7474 0.955251 13.7243C0.905275 13.7012 0.860894 13.6676 0.825168 13.6257C0.789442 13.5838 0.763221 13.5346 0.748313 13.4816C0.733405 13.4286 0.730165 13.3729 0.738816 13.3185L2.65907 1.1307C2.67647 1.02034 2.73264 0.919824 2.81748 0.84723C2.90232 0.774635 3.01027 0.73473 3.12189 0.734695H8.01648C10.3335 0.734695 12.0185 2.42229 11.9792 4.46657C11.4026 4.16388 10.7251 3.99086 9.98298 3.99086H5.90244C5.79076 3.99081 5.68273 4.03067 5.59781 4.10327C5.51289 4.17588 5.45666 4.27644 5.43926 4.38686L4.67072 9.2711L3.96236 13.7593H3.96273Z" />
                                                </svg>';
                                }
                                $return .= '</span>';
                                $return .= '<span class="fw-semi-bold">' . $label . "</span>";
                                $return .= '</label>';

                                return $return;
                            },
                            'tag' => 'section',
                            'class' => 'margin-top-400 d-grid grid-auto-fit',
                            'data-item-size' => 'small'
                        ]
                    )
                   ->label(false);
                   ?>

                <div class="divider"></div>
                <?= $form->field($model, 'read_terms', [
                        'options' => [
                            'class' => 'd-flex gap-1 align-items-center margin-top-300',
                        ],
                        'errorOptions' => [
                            'tag' => false,
                        ]
                    ])->checkbox([
                        'template' => '<div class="d-flex gap-1 align-items-center margin-top-300">
                            {input}{beginLabel}
                                <label class="fs-200 fw-medium letter-spacing-2">{label}</label>
                            {endLabel}{error}{hint}</div>',
                        'class' => 'fs-200 fw-medium letter-spacing-2',
                    ]) ?>
                <?= Html::submitButton('Confirmar', [
                    'class' => 'form__submit-button button fill-sm d-block push-to-center-md',
                    'data-size' => 'large-md',
                ]) ?>
            </section>
        <?php ActiveForm::end();?>
    </div>
</section>
