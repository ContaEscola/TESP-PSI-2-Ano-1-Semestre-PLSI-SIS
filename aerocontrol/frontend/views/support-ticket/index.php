<?php

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = "Meus Tickets Support";
$this->registerJsFile('@web/js/support-tickets.js', [
        'type' => 'module',
]);
?>

<section class="container padding-block-700" data-type="small-md">
    <h1 class="fs-600 fw-bold text-align-center">Meus Tickets Suporte</h1>

    <dialog id="newSupportTicketModal" class="[ modal container padding-300 ]" data-type="very-small-md"
            data-modal>
        <button class="[ modal__close-btn ] [ d-block push-to-right ]" data-close-modal>
            <span class="visually-hidden">
                Close modal
            </span>
            <img src="../images/close-icon.svg" alt="" aria-hidden="true">
        </button>

        <section class="margin-top-100 text-black-400">
            <form action="#">
                <p class="fs-400 fw-medium ">Criar um novo ticket!</p>
                <div class="flow margin-top-300" data-flow-space="small">
                    <div class="form__group">
                        <label for="title"
                               class="[ input__label ] [ fw-light margin-bottom-50 ]">Titulo:</label>
                        <input class="form__input" type="text" name="{TOCHANGE}" id="title" required>
                        <p class="[ input__error ] [ margin-top-50 ]"></p>
                    </div>
                    <div class="form__group">
                        <label for="message" class="[ input__label ] [ fw-light margin-bottom-50 ]">Mensagem:</label>
                        <textarea class="form__input resize-none" name="{TOCHANGE}" id="message" rows="7" required></textarea>
                        <p class="[ input__error ] [ margin-top-50 ]"></p>
                    </div>
                </div>
                <button type="submit" class="[ button ] [ d-block fill-sm margin-top-300 push-to-right-md ]">
                    Confirmar
                </button>
            </form>
        </section>
    </dialog>

    <button class=" [ button ] [ d-block margin-top-400 push-to-right ]" data-type="primary-outline" data-toggle="modal" data-target="#newSupportTicketModal" data-force-toggle-open="false">
        Novo Ticket
    </button>

    <div class="margin-top-100">
        <dialog class="[ support-ticket-modal ] [ modal container padding-300 ]" data-type="very-small-md"
                data-modal data-support-ticket-modal>
            <button class="[ modal__close-btn ] [ d-block push-to-right ]" data-close-modal><span
                        class="visually-hidden">Close
                            modal</span>
                <img src="../images/close-icon.svg" alt="" aria-hidden="true"></button>


            <section class="[ support-ticket-modal__image-item ] [ margin-top-400 margin-inline-auto ]">
                <img src="https://source.unsplash.com/WLUHO9A_xik/1600x900"
                     alt="Imagem do item do support ticket">
            </section>
        </dialog>
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'summary' => '',
                'options' => [
                    'tag' => 'ul',
                    'class' => 'flow',
                    'role' => 'list',
                    'data-flow-space' => 'medium'

                ],
                'emptyText' => "<p class='fw-medium text-align-center'> Você ainda não fez nenhum ticket!</p>",
                'itemView' => '_ticket',
            ]); ?>
    </div>


</section>