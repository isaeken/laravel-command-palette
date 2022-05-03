<?php

namespace IsaEken\LaravelCommandPalette\CommandPalette\Commands;

use IsaEken\LaravelCommandPalette\Abstracts\Command;
use IsaEken\LaravelCommandPalette\Enums\Icon;

class Settings extends Command
{
    protected string $name = 'Settings';

    protected string|null $description = 'Go to your account settings.';

    protected Icon|string|null $icon = Icon::MaterialSettings;

    protected string|int|null $groupId = 'account';

    /**
     * @inheritDoc
     */
    public function execute(...$arguments): void
    {
        $this->redirectToRoute('home');
    }
}
