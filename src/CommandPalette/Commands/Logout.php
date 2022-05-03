<?php

namespace IsaEken\LaravelCommandPalette\CommandPalette\Commands;

use IsaEken\LaravelCommandPalette\Abstracts\Command;
use IsaEken\LaravelCommandPalette\Enums\Icon;

class Logout extends Command
{
    protected string $name = 'Logout';

    protected string|null $description = 'Logout of your account.';

    protected Icon|string|null $icon = Icon::MaterialLogout;

    protected string|int|null $groupId = null;

    /**
     * @inheritDoc
     */
    public function execute(...$arguments): void
    {
        $this->redirectToRoute('home');
    }
}
