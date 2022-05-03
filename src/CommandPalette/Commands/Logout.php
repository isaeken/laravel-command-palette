<?php

namespace IsaEken\LaravelCommandPalette\CommandPalette\Commands;

use IsaEken\LaravelCommandPalette\Command;

class Logout extends Command
{
    protected string $name = 'Logout';

    protected string|null $description = 'Logout of your account.';

    protected string|int|null $groupId = 'account';

    /**
     * @inheritDoc
     */
    public function execute(): void
    {
        $this->redirectToRoute('home', ['test' => 'qwe']);
        $this->abort(404);
    }
}
