<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>


    <link rel="icon" type="image/png" sizes="32x32" href="<?= Url::to('@web/images/logo-url-icon.png' )?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap"rel="stylesheet">


    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="body-grid">
<?php $this->beginBody() ?>


    <header class="[ primary-header ] [ padding-block-100 bg-neutral-400 ]">
        <div class="container">
            <div class="nav-wrapper">
                <a href="<?= Url::to('@web/site/index' )?>">
                    <picture>
                        <source srcset="<?= Url::to('@web/images/logo-pc.svg' )?>" media="(min-width: 40em)">
                        <img src="<?= Url::to('@web/images/logo-mobile.svg' )?>" alt="Logo">
                    </picture>
                </a>
                <button class="[ navbar-toggle ] [ d-none-md push-to-right ] " aria-controls="primary-navigation"
                        aria-expanded="false">
                    <img class="open-icon" src="<?= Url::to('@web/images/hamburger-icon.svg' )?>" alt="" aria-hidden="true">
                    <img class="close-icon" src="<?= Url::to('@web/images/close-icon.svg' )?>" alt="" aria-hidden="true">
                    <span class="visually-hidden">Menu</span>
                </button>
                <nav aria-label="Primary" class="primary-navigation" id="primary-navigation">
                    <ul role="list" class="navigation-list">
                        <li class="[ primary-navigation__item ] [ push-to-right ]" data-type="active">
                            <a href="<?= Url::to('@web/site/index' )?>" class="[ primary-navigation__link ] [ fs-300 ]">Home</a>
                        </li>
                        <li class="primary-navigation__item">
                            <a href="<?= Url::to('@web/site/voos' )?>" class="[ primary-navigation__link ] [ fs-300 ]">Voos</a>
                        </li>
                        <li class="primary-navigation__item">
                            <a href="<?= Url::to('@web/site/restaurantes' )?>" class="[ primary-navigation__link ] [ fs-300 ]">Restaurantes</a>
                        </li>
                        <li class="[ primary-navigation__item ] [ push-to-left ]">
                            <a href="<?= Url::to('@web/site/lojas' )?>" class="[ primary-navigation__link ] [ fs-300 ]">Lojas</a>
                        </li>
                        <li class="primary-navigation__item">
                            <a href="<?= Url::to('@web/site/signup' )?>" class="button" data-type="primary-outline">Sign Up</a>
                        </li>
                        <li class="primary-navigation__item"><a href="<?= Url::to('@web/site/login' )?>" class="button">Login</a></li>
                        <?= Html::a('<i class="fas fa-sign-out-alt">logout</i>', ['/site/logout'], ['data-method' => 'post', 'class' => 'nav-link']) ?>
                    </ul>
                </nav>
            </div>
        </div>
    </header>


        <?= $content ?>

<footer >
    <div class="[ footer-wrapper ] [ container text-align-center ]">
        <nav aria-label="Footer">
            <ul role="list" class="footer-list">
                <li class="footer-list__item"><a href="#"
                                                 class="[ footer__link ] [ fs-350 letter-spacing-2 ]">Termos e Condições</a></li>
                <li class="footer-list__item"><a href="#"
                                                 class="[ footer__link ] [ fs-350 letter-spacing-2 ]">Política de privacidade</a>
                </li>
                <li class="footer-list__item"><a href="#"
                                                 class="[ footer__link ] [ fs-350 letter-spacing-2 ]">Contactar Suporte</a></li>
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
