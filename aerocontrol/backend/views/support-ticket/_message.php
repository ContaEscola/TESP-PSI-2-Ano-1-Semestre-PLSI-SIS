<?php

/** @var \common\models\TicketMessage $model */
/** @var int $client_id */

use yii\helpers\Html;

?>

    <?php
    if ($client_id != $model->sender_id){
    ?>
        <div class="d-flex flex-row justify-content-end mb-4 pt-1">
            <div class="mw-50">
                <span class="small d-block font-italic text-right mb-2"><?= Html::encode($model->sender_id) ?></span>
                <p class="p-2 me-3 mb-1 text-white rounded bg-primary text-break">
                    <?= Html::encode($model->message) ?>
                </p>
            </div>
        </div>
    <?php
    }else{
    ?>
        <div class="d-flex flex-row justify-content-start mb-4">
            <div class="mw-50">
                <span class="small d-block font-italic text-left mb-2"><?= Html::encode($model->sender_id) ?></span>
                <p class="p-2 ms-3 mb-1 rounded" style="background-color: #f5f6f7;">
                    <?= Html::encode($model->message) ?>
                </p>
            </div>
        </div>
    <?php
    }
    ?>