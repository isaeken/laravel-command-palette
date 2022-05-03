<?php

use IsaEken\LaravelCommandPalette\CommandPalette;

if (! function_exists('getCommandPalette')) {
    function getCommandPalette(): CommandPalette
    {
        return app(CommandPalette::class);
    }
}
