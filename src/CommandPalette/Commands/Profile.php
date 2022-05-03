<?php

namespace IsaEken\LaravelCommandPalette\CommandPalette\Commands;

use IsaEken\LaravelCommandPalette\Abstracts\Command;
use IsaEken\LaravelCommandPalette\Enums\Icon;

class Profile extends Command
{
    protected string $name = 'My Profile';

    protected string|null $description = 'Go to your profile.';

    protected Icon|string|null $icon = Icon::MaterialPerson;

    protected string|int|null $groupId = 'account';

    /**
     * @inheritDoc
     */
    public function execute(...$arguments): void
    {
        $this->redirectToRoute('home');
    }
}
