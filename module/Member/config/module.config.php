<?php 
namespace Member;

use Zend\ServiceManager\Factory\InvokableFactory;

return [
    // 'controllers' => [
    //     'factories' => [
    //         Controller\MemberController::class => InvokableFactory::class,
    //     ],
    // ],

    'router' => [
        'routes' => [
            'member' => [
                'type'    => 'segment', //Segment::class,
                'options' => [
                    'route' => '/member[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\MemberController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            'member' => __DIR__ . '/../view',
        ],
    ],
];
