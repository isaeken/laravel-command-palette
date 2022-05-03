<?php

namespace IsaEken\LaravelCommandPalette\Abstracts;

use IsaEken\LaravelCommandPalette\CommandPalette;
use IsaEken\LaravelCommandPalette\Contracts;

abstract class ResourceCommand extends Command implements Contracts\Command
{
    public int|null $index = null;

    /**
     * @inheritdoc
     */
    public function getId(): string
    {
        if (array_key_exists(static::class, CommandPalette::$commandIdCache)) {
            return CommandPalette::$commandIdCache[static::class.$this->index];
        }

        return CommandPalette::$commandIdCache[static::class.$this->index] = md5(static::class.$this->index);
    }
}
