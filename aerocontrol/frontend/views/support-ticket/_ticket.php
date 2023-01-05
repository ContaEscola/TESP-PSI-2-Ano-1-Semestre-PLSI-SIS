<?php

/** @var \common\models\SupportTicket $model */

use yii\helpers\Html;
use yii\helpers\Url;
?>
<li>
    <article
            class="[ support-ticket__item ] [ d-grid grid-auto-flow-column-md bg-primary border-radius-1 outline-1 padding-100 ]"
            data-support-ticket>
        <p class="fs-350 fw-medium">Ticket nº<?= Html::encode($model->id) ?> - <?= Html::encode($model->title) ?></p>
        <p class="fs-350 margin-top-100-sm">Estado: <span
                    class="fw-medium fs-italic"><?= Html::encode($model->state) ?></span></p>

        <?php
            if ($model->state == "Concluido"){
                ?>
                <input type="hidden" name="support-ticket-item-image"
                       data-image-path="https://source.unsplash.com/photos/random"
                       data-support-ticket-item-img>
                <div
                        class="d-flex flex-flow-column-sm justify-content-space-between margin-top-200-sm gap-2">
                    <button class="[ button ]" data-type="secondary-outline"
                            data-support-ticket-see-item>Ver
                        item</button>
                    <button class="[ button ] [ push-to-right-md ]">Ver mais
                        detalhes</button>
                </div>
                <?php
            }else{
                ?>
                <div class="d-flex flex-flow-column-sm justify-content-space-between margin-top-200-sm gap-2">
                    <button class="[ button ] [ push-to-right-md ]">Ver mais
                        detalhes</button>
                </div>
        <?php
            }
        ?>




    </article>

</li>