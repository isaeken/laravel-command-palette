<?php

namespace IsaEken\LaravelCommandPalette\CommandPalette\Commands;

use Illuminate\Support\Facades\Artisan;
use IsaEken\LaravelCommandPalette\Command;
use IsaEken\LaravelCommandPalette\Enums\Icon;

class CacheClear extends Command
{
    protected string $name = 'Clear Cache';

    protected string|null $description = 'Clear your application cache.';

    protected Icon|string|null $icon = Icon::MaterialCached;

    protected string|int|null $groupId = 'utilities';

    /**
     * @inheritDoc
     */
    public function execute(): void
    {
        Artisan::call('cache:clear');
        $this->alert('Cache cleared!');
    }
}
