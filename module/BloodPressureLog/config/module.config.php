<?php
return [
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'controllers' => [
        'invokables' => [
            'BloodPressureLog\Controller\BloodPressureLog' => 'BloodPressureLog\Controller\BloodPressureLogController'
        ],
    ],
    'router' => [
        'routes' => [
            'bloodpressurelog' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/bloodpressurelog[/:action][/:id]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => 'BloodPressureLog\Controller\BloodPressureLog',
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
];