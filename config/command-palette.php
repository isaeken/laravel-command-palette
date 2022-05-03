<?php

use IsaEken\LaravelCommandPalette\CommandPalette\Commands;

return [
    'commands' => [
        Commands\CacheClear::class,
        Commands\ChangePassword::class,
        Commands\Logout::class,
        Commands\Profile::class,
        Commands\Settings::class,
    ],

    'groups' => [
        'testing' => [
            'name' => 'Testing',
            'description' => 'This is testing group.',
        ],
        'utilities' => 'Utilities',
        'account' => 'Account',
    ],

    'tips' => [
        'Go to your accessibility settings to change your keyboard shortcuts',
        'Type ``#`` to search tags',
        'Type ``>`` to activate command mode',
        'Type ``@`` to search people',
    ],
];
