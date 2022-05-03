<?php

use IsaEken\LaravelCommandPalette\CommandPalette\Commands;
use IsaEken\LaravelCommandPalette\CommandPalette\Resources;

return [
    'commands' => [
        Commands\CacheClear::class,
        Commands\ChangePassword::class,
        Commands\Logout::class,
        Commands\Profile::class,
        Commands\Settings::class,
    ],

    'resources' => [
        Resources\UserProfile::class,
    ],

    'groups' => [
        'testing' => [
            'name' => 'Testing',
            'description' => 'This is testing group.',
        ],
        'utilities' => 'Utilities',
        'account' => 'Account',
        'users' => 'Users',
    ],

    'tips' => [
        'Go to your accessibility settings to change your keyboard shortcuts',
        'Type ``#`` to search tags',
        'Type ``>`` to activate command mode',
        'Type ``@`` to search people',
    ],
];
