<?php

use IsaEken\LaravelCommandPalette\CommandPalette\Commands\Logout;

return [
    'commands' => [
        Logout::class,
    ],

    'groups' => [
        'testing' => [
            'name' => 'Testing',
            'description' => 'This is testing group.',
        ],
        'utilities' => 'Utilities',
        'account' => 'Account',
    ],
];
