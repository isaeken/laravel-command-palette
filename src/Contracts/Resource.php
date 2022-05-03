<?php

namespace IsaEken\LaravelCommandPalette\Contracts;

interface Resource extends Command
{
    /**
     * @return string|int
     */
    public function getItemId(): string|int;

    /**
     * @return array<Resource>
     */
    public static function get(): array;
}
