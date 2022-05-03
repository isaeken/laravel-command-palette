<?php

namespace IsaEken\LaravelCommandPalette\Traits;

trait HasCommandPaletteResponses
{
    public function redirect(string $to): void
    {
        getCommandPalette()->responses[] = [
            'type' => 'redirect',
            'data' => $to,
        ];
    }

    public function redirectToRoute(string $name, $parameters = [], $absolute = true): void
    {
        $this->redirect(route($name, $parameters, $absolute));
    }

    public function abort(int|null $code = null, string|null $message = null): void
    {
        getCommandPalette()->responses[] = [
            'type' => 'aborted',
            'data' => [
                'code' => $code,
                'message' => $message,
            ],
        ];
    }

    public function alert(string $message): void
    {
        getCommandPalette()->responses[] = [
            'type' => 'alert',
            'data' => $message,
        ];
    }

    public function log(string $message): void
    {
        getCommandPalette()->responses[] = [
            'type' => 'log',
            'data' => $message,
        ];
    }
}