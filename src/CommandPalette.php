<?php

namespace IsaEken\LaravelCommandPalette;

use Illuminate\Support\Collection;

class CommandPalette
{
    public Collection $commands;

    public array $responses = [];

    public function __construct()
    {
        $this->commands = new Collection();
    }

    public function renderHead(): string
    {
        $cssRoute = route('command-palette.web.assets.css');
        $jsRoute = route('command-palette.web.assets.js');

        $html = "<link rel=\"stylesheet\" type=\"text/css\" property=\"stylesheet\" href=\"$cssRoute\">";
        $html .= "<link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">";
        $html .= "<link rel=\"preconnect\" href=\"https://fonts.gstatic.com\" crossorigin>";
        $html .= "<link href=\"https://fonts.googleapis.com/css2?family=Roboto&display=swap\" rel=\"stylesheet\">";
        $html .= "<script src=\"$jsRoute\"></script>";

        return $html;
    }

    public function renderComponent(): string
    {
        return "<div id=\"laravel-command-palette\"></div>";
    }

    /**
     * @param  string|Contracts\Command  $command
     * @return $this
     */
    public function registerCommand(string|Contracts\Command $command): self
    {
        if ($command instanceof Contracts\Command) {
            $command = $command::class;
        }

        tap(new $command, function (Contracts\Command $command) {
            $this->commands[] = $command;
        });

        return $this;
    }

    /**
     * @param  bool  $condition
     * @param  string|\IsaEken\LaravelCommandPalette\Contracts\Command  $command
     * @return $this
     */
    public function registerCommandWhen(bool $condition, string|Contracts\Command $command): self
    {
        if ($command) {
            $this->registerCommand($command);
        }

        return $this;
    }

    /**
     * @param  bool  $condition
     * @param  string|\IsaEken\LaravelCommandPalette\Contracts\Command  $command
     * @return $this
     */
    public function registerCommandUnless(bool $condition, string|Contracts\Command $command): self
    {
        if (!$command) {
            $this->registerCommand($command);
        }

        return $this;
    }

    /**
     * @param  string  $commandId
     * @return Contracts\Command|null
     */
    public function getCommandById(string $commandId): Contracts\Command|null
    {
        return $this->commands->first(function (Contracts\Command $command) use ($commandId) {
            return $command->getId() === $commandId;
        });
    }

    /**
     * @param  string  $commandId
     * @return void
     */
    public function execute(string $commandId): void
    {
        $this->getCommandById($commandId)?->execute();
    }

    public function getCommands(): Collection
    {
        return $this
            ->commands
            ->filter(function (Contracts\Command $command) {
                if (!method_exists($command, 'shouldBeShown')) {
                    return true;
                }

                return app()->call([$command, 'shouldBeShown']);
            })
            ->values()
            ->map(function (Contracts\Command $command) {
                return [
                    'id' => $command->getId(),
                    'groupId' => $command->getGroupId(),
                    'name' => $command->getName(),
                    'description' => $command->getDescription(),
                    'icon' => $command->getIcon(),
                ];
            })
            ->collect();
    }
}