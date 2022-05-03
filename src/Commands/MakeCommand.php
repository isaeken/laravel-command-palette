<?php

namespace IsaEken\LaravelCommandPalette\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeCommand extends GeneratorCommand
{
    protected $name = 'make:palette-command';

    protected $description = 'Create a new Palette Command class.';

    protected $type = 'Palette Command';

    /**
     * @inheritDoc
     */
    protected function getStub(): string
    {
        return $this->resolveStubPath('/stubs/palette-command.stub');
    }

    /**
     * Resolve the fully-qualified path to the stub.
     *
     * @param  string  $stub
     * @return string
     */
    protected function resolveStubPath(string $stub): string
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__.'/../'.$stub;
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\CommandPalette';
    }
}
