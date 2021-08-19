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

        [
            'title' => 'Copier/Deplacer Plan',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Bezier-curve.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => '/copierDeplacerPlan',
            'new-tab' => false,
        ],
        // Edis Bordeaux
        [
            'section' => 'EDIS ENR (WHCREA)',
        ],
        [
            'title' => 'Ecritures Bancaires',
            'icon' => 'media/svg/icons/Design/PenAndRuller.svg',
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
            'title' => 'Tableaux',
            'icon' => 'media/svg/icons/Layout/Layout-left-panel-2.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Clients',
                    'page' => 'tableau/1/clients'
                ],
                [
                    'title' => 'Chantiers',
                    'page' => 'tableau/1/chantiers'
                ],
                [
                    'title' => 'Devis',
                    'page' => 'tableau/1/devis'
                ],
                [
                    'title' => 'Factures',
                    'page' => 'tableau/1/factures'
                ],
                [
                    'title' => 'Réglements',
                    'page' => 'tableau/1/reglements'
                ],
            ]
        ],
        [
            'title' => 'Documents',
            'icon' => 'media/svg/icons/Files/Folder-cloud.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Devis',
                    'page' => 'document/1/devis'
                ],
                [
                    'title' => 'Factures',
                    'page' => 'document/1/factures'
                ],
            ]
        ],

    ]

];
