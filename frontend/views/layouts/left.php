<?php

use dmstr\widgets\Menu;

?>

<aside class="main-sidebar">

    <section class="sidebar">

        <?php 

        Menu::$iconClassPrefix = 'fa fa-fw fa-'; 
        // $user = Yii::$app->user;

        echo Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    [
                        'label' => 'Menu', 
                        'options' => [
                            'class' => 'header'
                        ], 
                        // 'visible' => $user->can('viewPages'),
                    ],
                    [
                        'label' => 'Data Wajib Pajak', 
                        'icon' => 'id-card-o', 
                        'url' => [
                            'subjek-pajak/index'
                        ],
                        // 'visible' => $user->can('viewPages'),
                    ],
                    [
                        'label' => 'Kelola Objek Pajak', 
                        'icon' => 'map-marker', 
                        'url' => [
                            'objek-pajak/index'
                        ],
                        // 'visible' => $user->can('viewPages'),
                    ],
                    [
                        'label' => 'Permohonan', 
                        'icon' => 'edit', 
                        'url' => [
                            'permohonan/index'
                        ],
                    ],
                    [
                        'label' => 'Ketetapan & Piutang', 
                        'icon' => 'paste', 
                        'url' => [
                            'ketetapan/index'
                        ],
                    ],
                    [
                        'label' => 'Pembayaran', 
                        'icon' => 'credit-card', 
                        'url' => [
                            'pembayaran/index'
                        ],
                    ],
                    [
                        'label' => 'Pengaduan', 
                        'icon' => 'comments', 
                        'url' => [
                            'aduan/index'
                        ],
                        // 'visible' => $user->can('viewPages'),
                    ]
                    
                    // ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    // [
                    //     'label' => 'Some tools',
                    //     'icon' => 'share',
                    //     'url' => '#',
                    //     'items' => [
                    //         ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                    //         ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                    //         [
                    //             'label' => 'Level One',
                    //             'icon' => 'circle-o',
                    //             'url' => '#',
                    //             'items' => [
                    //                 ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                    //                 [
                    //                     'label' => 'Level Two',
                    //                     'icon' => 'circle-o',
                    //                     'url' => '#',
                    //                     'items' => [
                    //                         ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                    //                         ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                    //                     ],
                    //                 ],
                    //             ],
                    //         ],
                    //     ],
                    // ],
                ],
            ]
        ) ?>


    </section>

</aside>
