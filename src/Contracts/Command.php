<?php

namespace IsaEken\LaravelCommandPalette\Contracts;

use IsaEken\LaravelCommandPalette\Enums\Icon;

interface Command
{
    /**
     * Get ID of the command.
     *
     * @return string
     */
    public function getId(): string;

    /**
     * Get name/title of the command.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get description of the command.
     *
     * @return string|null
     */
    public function getDescription(): string|null;

    /**
     * Get icon name of the command.
     *
     * @return string|Icon|null
     */
    public function getIcon(): string|Icon|null;

    /**
     * Get group id of the command.
     *
     * @return string|int|null
     */
    public function getGroupId(): string|int|null;

    /**
     * Check command is show.
     *
     * @return bool
     */
    public function shouldBeShown(): bool;

    /**
     * Execute command.
     *
     * @return void
     */
    public function execute(): void;
}
