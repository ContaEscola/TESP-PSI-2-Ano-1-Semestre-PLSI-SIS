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
             echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    [
                        'label' => 'Aeroporto',
                        'icon'=>'fas fa-solid fa-plane',
                        'items' => [
                            ['label' => 'Voos','url' => ['/flight/index'], 'iconStyle' => 'far','icon'],
                            ['label' => 'Aeroportos','url' => ['/airport/index'], 'iconStyle' => 'far'],
                            ['label' => 'Aviões', 'url' => ['/airplane/index'],'iconStyle' => 'far'],
                            ['label' => 'Companhias','url' => ['/company/index'], 'iconStyle' => 'far']
                        ]
                    ],
                    [
                        'label' => 'Utilizadores',
                        'icon'=>'fas fa-solid fa-user',
                        'items' => [
                            ['label' => 'Trabalhadores','url' => ['/employee/index'], 'iconStyle' => 'far'],
                            ['label' => 'Clientes','url' => ['/client/index'], 'iconStyle' => 'far']
                        ]
                    ],
                    [
                        'icon'=>'fas fa-solid fa-suitcase-rolling',
                        'label' => 'Perdidos e Achados',
                        'items' => [
                            ['label' => 'Itens','url' => ['/lostitem/index'], 'iconStyle' => 'far'],
                            ['label' => 'Suporte ao cliente','url' => ['/supportticket/index'], 'iconStyle' => 'far']
                        ]
                    ],
                    ['label' => 'Métodos de Pagamento','icon'=>'fas fa-solid fa-credit-card', 'url' => ['/paymentmethod/index'], 'target' => '_blank'],
                    ['label' => 'Restaurantes', 'url' => ['/restaurant/index'],'icon'=>'fas fa-solid fa-utensils', 'target' => '_blank'],
                    ['label' => 'Lojas', 'url' => ['/store/index'],'icon'=>'fas fa-solid fa-shopping-cart', 'target' => '_blank'],
                    ['label' => 'Server Log', 'url' => ['/serverlog'],'icon'=>'fas fa-solid fa-info', 'target' => '_blank'],
                ],
            ]);
            //MANAGER
            /*echo Menu::widget([
                'items' => [

                    ['label' => 'Restaurantes', 'url' => ['/restaurant/view'],'icon'=>'fas fa-house-user', 'target' => '_blank'],
                    ['label' => 'Ementa', 'url' => ['/restaurantitem/index'],'icon'=>'fas fa-solid fa-utensils', 'target' => '_blank'],
                ],
            ]);*/
            // EMPLOYEE
            /*echo Menu::widget([
                'items' => [
                    [
                        'label' => 'Aeroporto',
                        'icon'=>'fas fa-solid fa-plane',
                        'items' => [
                            ['label' => 'Voos','url' => ['/flight/index'], 'iconStyle' => 'far'],
                            ['label' => 'Aeroportos','url' => ['/airport/index'], 'iconStyle' => 'far'],
                            ['label' => 'Aviões','url' => ['/airplane/index'], 'iconStyle' => 'far'],
                        ]
                    ],
                    [
                        'label' => 'Perdidos e Achados',
                        'icon'=>'fas fa-solid fa-suitcase-rolling',
                        'items' => [
                            ['label' => 'Itens','url' => ['/lostitem/index'], 'iconStyle' => 'far'],
                            ['label' => 'Suporte ao cliente','url' => ['/supportticket/index'], 'iconStyle' => 'far']
                        ]
                    ],
                    ['label' => 'Clientes', 'url' => ['/client/index'],'icon'=>'fas fa-solid fa-user', 'target' => '_blank'],
                    ['label' => 'Métodos de Pagamento', 'url' => ['/paymentmethod/index'],'icon'=>'fas fa-solid fa-credit-card', 'target' => '_blank'],
                ],
            ]);*/ ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>