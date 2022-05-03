<?php

namespace IsaEken\LaravelCommandPalette\Abstracts;

use IsaEken\LaravelCommandPalette\CommandPalette;
use IsaEken\LaravelCommandPalette\Contracts;
use IsaEken\LaravelCommandPalette\Enums\Icon;
use IsaEken\LaravelCommandPalette\Traits\HasCommandPaletteResponses;

abstract class Command implements Contracts\Command
{
    use HasCommandPaletteResponses;

    protected string $name;

    protected string|null $description = null;

    protected string|Icon|null $icon = null;

    protected string|int|null $groupId = null;

    /**
     * @inheritdoc
     */
    public function getId(): string
    {
        if (array_key_exists(static::class, CommandPalette::$commandIdCache)) {
            return CommandPalette::$commandIdCache[static::class];
        }

        return CommandPalette::$commandIdCache[static::class] = md5(static::class);
    }

    /**
     * @inheritdoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function getDescription(): string|null
    {
        return $this->description;
    }

    /**
     * @inheritdoc
     */
    public function getIcon(): string|Icon|null
    {
        return $this->icon;
    }

    /**
     * @inheritdoc
     */
    public function getGroupId(): string|int|null
    {
        return $this->groupId;
    }

    /**
     * @inheritdoc
     */
    public function shouldBeShown(): bool
    {
        return true;
    }
}
