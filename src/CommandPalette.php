<?php

namespace IsaEken\LaravelCommandPalette;

use Illuminate\Support\Collection;
use IsaEken\LaravelCommandPalette\Abstracts\ResourceCommand;
use IsaEken\LaravelCommandPalette\Contracts\Command;

class CommandPalette
{
    public Collection $commands;

    public array $responses = [];

    public static array $commandIdCache = [];

    private Collection|null $commandCache = null;

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
     * @param  string|Command  $command
     * @return $this
     */
    public function registerCommand(string|Command $command): self
    {
        $command = $command instanceof Command
            ? $command
            : new $command();

        tap($command, function (Command $command) {
            $this->commands[] = $command;
        });

        return $this;
    }

    /**
     * @param  bool  $condition
     * @param  string|Command  $command
     * @return $this
     */
    public function registerCommandWhen(bool $condition, string|Command $command): self
    {
        if ($condition) {
            $this->registerCommand($command);
        }

        return $this;
    }

    /**
     * @param  bool  $condition
     * @param  string|Command  $command
     * @return $this
     */
    public function registerCommandUnless(bool $condition, string|Command $command): self
    {
        if (! $condition) {
            $this->registerCommand($command);
        }

        return $this;
    }

    /**
     * @param  string  $commandId
     * @return Command|null
     */
    public function getCommandById(string $commandId): Command|null
    {
        return $this->getCommands()->first(function (Command $command) use ($commandId) {
            return $command->getId() === $commandId;
        });
    }

    /**
     * @param  string  $commandId
     * @param  array  $arguments
     * @return void
     */
    public function execute(string $commandId, array $arguments): void
    {
        $this->getCommandById($commandId)?->execute($arguments);
    }

    public function getCommands(): Collection
    {
        if ($this->commandCache != null) {
            return $this->commandCache;
        }

        $commands = $this
            ->commands
            ->filter(function (Command $command) {
                if (! method_exists($command, 'shouldBeShown')) {
                    return true;
                }

                return app()->call([$command, 'shouldBeShown']);
            })
            ->values();

        /** @var Contracts\Resource $resource */
        foreach (config('command-palette.resources', []) as $resource) {
            $commands = $commands->merge(
                collect($resource::get())
                    ->map(function (ResourceCommand $command, $index) {
                        $command->index = $index;

                        return $command;
                    })
            );
        }

        return $this->commandCache = $commands;
    }
}
