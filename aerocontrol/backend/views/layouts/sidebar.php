<?php

use hail812\adminlte\widgets\Menu;

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?=$assetDir?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=$assetDir?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
         <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            //ADMIN
            /* echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    ['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank'],
                    [
                        'label' => 'Aeroporto',
                        'items' => [
                            ['label' => 'Voos', 'iconStyle' => 'far'],
                            ['label' => 'Aeroportos', 'iconStyle' => 'far'],
                            ['label' => 'Aviões', 'iconStyle' => 'far'],
                            ['label' => 'Companhias', 'iconStyle' => 'far']
                        ]
                    ],
                    [
                        'label' => 'Utilizadores',
                        'items' => [
                            ['label' => 'Trabalhadores', 'iconStyle' => 'far'],
                            ['label' => 'Clientes', 'iconStyle' => 'far']
                        ]
                    ],
                    [
                        'label' => 'Perdidos e Achados',
                        'items' => [
                            ['label' => 'Itens', 'iconStyle' => 'far'],
                            ['label' => 'Suporte ao cliente', 'iconStyle' => 'far']
                        ]
                    ],
                    ['label' => 'Métodos de Pagamento', 'url' => ['/debug'], 'target' => '_blank'],
                    ['label' => 'Restaurantes', 'url' => ['/debug'], 'target' => '_blank'],
                    ['label' => 'Lojas', 'url' => ['/debug'], 'target' => '_blank'],
                    ['label' => 'Server Log', 'url' => ['/debug'], 'target' => '_blank'],
                ],
            ]);*/
            //MANAGER
            /*echo Menu::widget([
                'items' => [

                    ['label' => 'Restaurantes', 'url' => ['/debug'], 'target' => '_blank'],
                    ['label' => 'Ementa', 'url' => ['/debug'], 'target' => '_blank'],
                ],
            ]);*/
            // EMPLOYEE
            echo Menu::widget([
                'items' => [
                    [
                        'label' => 'Aeroporto',
                        'items' => [
                            ['label' => 'Voos', 'iconStyle' => 'far'],
                            ['label' => 'Aeroportos', 'iconStyle' => 'far'],
                            ['label' => 'Aviões', 'iconStyle' => 'far'],
                        ]
                    ],
                    [
                        'label' => 'Perdidos e Achados',
                        'items' => [
                            ['label' => 'Itens', 'iconStyle' => 'far'],
                            ['label' => 'Suporte ao cliente', 'iconStyle' => 'far']
                        ]
                    ],
                    ['label' => 'Clientes', 'url' => ['/debug'], 'target' => '_blank'],
                    ['label' => 'Métodos de Pagamento', 'url' => ['/debug'], 'target' => '_blank'],
                ],
            ]); ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>