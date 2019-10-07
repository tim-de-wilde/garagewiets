<?php
namespace garagewiets\bin;

return [
    'propel' => [
        'database' => [
            'connections' => [
                'garagewiets' => [
                    'adapter'    => 'mysql',
                    'classname'  => 'Propel\Runtime\Connection\ConnectionWrapper',
                    'dsn'        => 'mysql:host=localhost;dbname=garagewiets',
                    'user'       => 'garagewiets',
                    'password'   => 'wolletje',
                    'attributes' => []
                ]
            ]
        ],
        'runtime' => [
            'defaultConnection' => 'garagewiets',
            'connections' => ['garagewiets']
        ],
        'generator' => [
            'defaultConnection' => 'garagewiets',
            'connections' => ['garagewiets']
        ]
    ]
];
