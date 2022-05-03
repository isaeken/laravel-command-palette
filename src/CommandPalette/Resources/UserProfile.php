<?php

namespace IsaEken\LaravelCommandPalette\CommandPalette\Resources;

use App\Models\User;
use IsaEken\LaravelCommandPalette\Abstracts\ResourceCommand;
use IsaEken\LaravelCommandPalette\Contracts\Resource;

class UserProfile extends ResourceCommand implements Resource
{
    protected string $name = 'Go to :name\'s profile';

    protected string|int|null $groupId = 'users';

    public function __construct(public User $user)
    {
        $this->name = str($this->name)->replace(':name', $user->name)->value();
        $this->icon = 'https://www.gravatar.com/avatar/'.md5(strtolower(trim($user->email)));
    }

    /**
     * @inheritdoc
     */
    public function getItemId(): string|int
    {
        return $this->user->id;
    }

    /**
     * @inheritDoc
     */
    public function execute(...$arguments): void
    {
        $user = User::findOrFail($arguments[0]);
        $this->log($user);
    }

    /**
     * @inheritDoc
     */
    public static function get(): array
    {
        return User::all()->collect()->map(function (User $user) {
            return new static($user);
        })->toArray();
    }
}
