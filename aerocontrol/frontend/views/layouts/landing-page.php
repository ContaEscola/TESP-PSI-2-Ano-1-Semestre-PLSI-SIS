<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Html;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>


    <link rel="icon" type="image/png" sizes="32x32" href="<?= Url::to('@web/images/logo-url-icon.png') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">


    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody();
    echo Alert::widget(); ?>

    <div class="only-nav-main-visible-first-page">
        <header class="[ primary-header ] [ padding-block-100 bg-neutral-400 ]">
            <div class="container">
                <div class="nav-wrapper">
                    <a href="<?= Url::to(['site/index']) ?>">
                        <picture>
                            <source srcset="<?= Url::to('@web/images/logo-pc.svg') ?>" media="(min-width: 40em)">
                            <img src="<?= Url::to('@web/images/logo-mobile.svg') ?>" alt="Logo">
                        </picture>
                    </a>
                    <button class="[ navbar-toggle ] [ d-none-md push-to-right ] " aria-controls="primary-navigation" aria-expanded="false">
                        <img class="open-icon" src="<?= Url::to('@web/images/hamburger-icon.svg') ?>" alt="" aria-hidden="true">
                        <img class="close-icon" src="<?= Url::to('@web/images/close-icon.svg') ?>" alt="" aria-hidden="true">
                        <span class="visually-hidden">Menu</span>
                    </button>
                    <?php if (Yii::$app->user->isGuest) : ?>
                        <nav aria-label="Primary" class="primary-navigation" id="primary-navigation">
                            <ul role="list" class="navigation-list">
                                <li class="[ primary-navigation__item ] [ push-to-right ]" data-type="active">
                                    <a href="<?= Url::to(['site/index']) ?>" class="[ primary-navigation__link ] [ fs-300 ]">Home</a>
                                </li>
                                <li class="primary-navigation__item">
                                    <a href="<?= Url::to(['site/voos']) ?>" class="[ primary-navigation__link ] [ fs-300 ]">Voos</a>
                                </li>
                                <li class="primary-navigation__item">
                                    <a href="<?= Url::to(['site/restaurantes']) ?>" class="[ primary-navigation__link ] [ fs-300 ]">Restaurantes</a>
                                </li>
                                <li class="[ primary-navigation__item ] [ push-to-left ]">
                                    <a href="<?= Url::to(['site/lojas']) ?>" class="[ primary-navigation__link ] [ fs-300 ]">Lojas</a>
                                </li>
                                <li class="primary-navigation__item">
                                    <a href="<?= Url::to(['site/signup']) ?>" class="button" data-type="primary-outline">Sign Up</a>
                                </li>
                                <li class="primary-navigation__item"><a href="<?= Url::to(['site/login']) ?>" class="button">Login</a></li>
                            </ul>
                        </nav>
                    <?php else : ?>
                        <nav aria-label="Primary" class="primary-navigation" id="primary-navigation">
                            <ul role="list" class="navigation-list">
                                <li class="[ primary-navigation__item ] [ push-to-right ]" data-type="active">
                                    <a href="<?= Url::to(['site/index']) ?>" class="[ primary-navigation__link ] [ fs-300 ]">Home</a>
                                </li>
                                <li class="primary-navigation__item">
                                    <a href="<?= Url::to(['site/voos']) ?>" class="[ primary-navigation__link ] [ fs-300 ]">Voos</a>
                                </li>
                                <li class="primary-navigation__item">
                                    <a href="<?= Url::to(['site/restaurantes']) ?>" class="[ primary-navigation__link ] [ fs-300 ]">Restaurantes</a>
                                </li>
                                <li class="[ primary-navigation__item ] [ push-to-left ]">
                                    <a href="<?= Url::to(['site/lojas']) ?>" class="[ primary-navigation__link ] [ fs-300 ]">Lojas</a>
                                </li>
                                <li class="primary-navigation__item d-flex justify-content-center">
                                    <div class="dropdown " data-type="navbar">
                                        <button class="dropdown-button button" data-type="primary-outline" aria-expanded="false" data-dropdown>
                                            <?= \Yii::$app->user->identity->first_name . " " . Yii::$app->user->identity->last_name ?>
                                            <span aria-hidden="true">
                                                <svg class="icon dropdown__toggle-icon">
                                                    <use xlink:href="<?= Url::to("@web/images/caret.svg#caret") ?>"></use>
                                                </svg>
                                            </span>
                                        </button>
                                        <ul role="list" class="dropdown-menu">
                                            <li class="dropdown-menu__item">
                                                <a class="[ dropdown-menu__link ] [ text-primary-accent-400 ]" href="#"> Ver conta
                                                    <span aria-hidden="true">
                                                        <svg class="icon dropdown-link__icon">
                                                            <use xlink:href="<?= Url::to("@web/images/perfil-icon.svg#perfil-icon") ?>"></use>
                                                        </svg>
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="dropdown-menu__item">
                                                <?= Html::a('Logout' . '<span aria-hidden="true">
                                                        <svg class="icon dropdown-link__icon">
                                                            <use xlink:href="' . Url::to('@web/images/logout-icon.svg#logout-icon') . '"></use>
                                                        </svg>
                                                    </span>', ['site/logout'], ['data-method' => 'post', 'class' => '[ dropdown-menu__link ] [ text-primary-accent-400 ]']) ?>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                    <?php endif; ?>
                </div>
            </div>
        </header>

        <section class="[ hero ] [ d-grid place-content-center padding-block-700 ]">
            <h1 class="fs-600 fw-bold">Reserve já o seu próximo voo!</h1>
            <a href="#" class="button">Reservar</a>
        </section>
    </div>

    <main>
        <?= $content ?>
    </main>

    <footer>
        <div class="[ footer-wrapper ] [ container text-align-center ]">
            <nav aria-label="Footer">
                <ul role="list" class="footer-list">
                    <li class="footer-list__item"><a href="#" class="[ footer__link ] [ fs-350 letter-spacing-2 ]">Termos e Condições</a></li>
                    <li class="footer-list__item"><a href="#" class="[ footer__link ] [ fs-350 letter-spacing-2 ]">Política de privacidade</a>
                    </li>
                    <li class="footer-list__item"><a href="#" class="[ footer__link ] [ fs-350 letter-spacing-2 ]">Contactar Suporte</a></li>
                </ul>
            </nav>
            <p class="fs-100 fw-light letter-spacing-2 ">@ 2022 AeroControl. Todos os direitos
                reservados.</p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();
