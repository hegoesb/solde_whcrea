<?php
// Aside menu
return [

    'items' => [
        // Dashboard
        [
            'title' => 'Dashboard',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => '/',
            'new-tab' => false,
        ],

        // Edis Bordeaux
        [
            'section' => 'EDIS ENR (WHCREA)',
        ],
        [
            'title' => 'Ecritures Bancaires',
            'icon' => 'media/svg/icons/Shopping/Chart-bar2.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Toutes',
                    'page' => 'eb/toutes'
                ],
                [
                    'title' => '2021',
                    'page' => 'eb/2021'
                ],
                [
                    'title' => '2020',
                    'page' => 'eb/2020'
                ],
                [
                    'title' => '2019',
                    'page' => 'eb/2019'
                ],
                [
                    'title' => '2018',
                    'page' => 'eb/2018'
                ],
                [
                    'title' => '2017',
                    'page' => 'eb/2017'
                ],
            ]
        ],
        [
            'title' => 'Repartition',
            'root' => true,
            'icon' => 'media/svg/icons/Layout/Layout-left-panel-2.svg',
            'page' => 'repartition',
            'new-tab' => false,
        ],
        [
            'title' => 'Solde',
            'root' => true,
            'icon' => 'media/svg/icons/Cooking/Fork-spoon-knife.svg',
            'page' => 'solde',
            'new-tab' => false,
        ],
    ]

];
