<?php

namespace IsaEken\LaravelCommandPalette\CommandPalette\Commands;

use IsaEken\LaravelCommandPalette\Command;
use IsaEken\LaravelCommandPalette\Enums\Icon;

class ChangePassword extends Command
{
    protected string $name = 'Change password';

    protected string|null $description = 'Change your password.';

    protected Icon|string|null $icon = Icon::MaterialLock;

    protected string|int|null $groupId = 'account';

    /**
     * @inheritDoc
     */
    public function execute(): void
    {
        $this->redirectToRoute('home');
    }
}
