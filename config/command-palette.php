<?php

use IsaEken\LaravelCommandPalette\CommandPalette\Commands\Logout;

return [
    'commands' => [
        Logout::class,
    ],

    'groups' => [
        'testing' => 'Testing',
        'utilities' => 'Utilities',
        'account' => 'Account',
    ],
];