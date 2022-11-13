<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception $exception*/

use yii\helpers\Html;

$this->title = $name;
?>
<main>
    <div class="container padding-block-700 height-100">
        <div class="[ error-grid ] [ even-columns place-content-center text-align-center-sm height-100 ]">
            <picture>
                <source srcset="assets/error-icon-pc.svg" media="(min-width: 40em)">
                <img src="assets/error-icon-mobile.svg" alt="representação de erro">
            </picture>
            <div>
                <h1 class="fs-600 fw-bold"><?= Html::encode($this->title) ?></h1>
                <p class="margin-top-100"> <?= nl2br(Html::encode($message)) ?></p>
                <p>
                    O erro acima ocorreu enquanto o servidor Web estava processando a sua informação.
                </p>
                <p>
                    Entre em contacto conosco se achar que é um erro de servidor. Obrigado.
                </p>
            </div>
        </div>
    </div>
</main>
