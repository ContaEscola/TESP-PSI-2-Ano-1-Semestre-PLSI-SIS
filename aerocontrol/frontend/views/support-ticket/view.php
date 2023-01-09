<?php

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var \frontend\models\TicketMessageForm $model */
/** @var int $ticket_id */
/** @var string $ticket_title */
/** @var string $ticket_state */
/** @var int $client_id */

use kartik\form\ActiveForm;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\helpers\Html;

$this->title = "Meus Tickets Support";
?>

    <section class="padding-block-700">
        <div class="container" data-type="small-md">
            <h1 class="fs-550 fw-bold text-break max-width-35ch">
                Ticket nº<?php echo Html::encode($ticket_id); ?> - <span class="fw-medium"><?php echo Html::encode($ticket_title);?></span>
            </h1>
            <div class="d-flex justify-content-space-between margin-top-300">
                <p class="fw-medium letter-spacing-1">
                    Estado: <span class="italic"><?php echo Html::encode($ticket_state);?></span>
                </p>
                <a href="#" class="button" data-type="error">Fechar ticket</a>
            </div>
            <section class="margin-top-500 border-radius-1 box-shadow-1">
                <ul role="list" id="chat-messages" class="[ chat-messages-wrapper ]  [ padding-inline-300 padding-block-300 flow ]" data-flow-space="large">
                    <?= ListView::widget([
                        'dataProvider' => $dataProvider,
                        'viewParams' => ['client_id' => $client_id],
                        'summary' => '',
                        'options' => [
                            'tag' => 'ul',
                            'class' => 'flow',
                            'role' => 'list',
                            'data-flow-space' => 'medium'
                        ],
                        'emptyText' => "<p class='fw-medium text-align-center'> Você ainda não tem mensagens!</p>",
                        'itemView' => '_message',
                    ]); ?>
                </ul>
                <div class="chat-footer">
                    <form action="add-message" class="d-flex gap-0">
                        <div class="form__group flex-grow-1">
                            <label for="city" class="[ input__label ] [ margin-bottom-50 visually-hidden ]">
                                Mensagem para enviar:
                            </label>
                            <input class="[ form__input ] [ height-100 border-none border-top-radius-0 border-bottom-right-radius-0 ]"
                               type="text" name="{message}" pattern="[a-zA-Z\d]+" required
                               placeholder="Insira aqui a sua mensagem">
                        </div>
                        <button type="submit" class="[ button ] [ border-top-radius-0  border-bottom-left-radius-0 ] ">
                            <span class="visually-hidden">
                                Enviar mensagem
                            </span>
                            <span aria-hidden="true">
                                <svg class="icon">
                                    <use xlink:href="../images/send-message-icon.svg#send-message-icon"></use>
                                </svg>
                            </span>
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </section>
