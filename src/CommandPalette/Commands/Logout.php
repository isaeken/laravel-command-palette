<?php

namespace IsaEken\LaravelCommandPalette\CommandPalette\Commands;

use IsaEken\LaravelCommandPalette\Command;
use IsaEken\LaravelCommandPalette\Enums\Icon;

class Logout extends Command
{
    protected string $name = 'Logout';

    protected string|null $description = 'Logout of your account.';

    protected Icon|string|null $icon = Icon::MaterialLogout;

    protected string|int|null $groupId = 'account';

    /**
     * @inheritDoc
     */
    public function execute(): void
    {
        $this->alert('sa');
        $this->delay(5000);
        $this->log('test');
        $this->delay(1000);
        $this->log('redirecting..');
        $this->redirectToRoute('home', ['test' => 'qwe']);
    }
}
