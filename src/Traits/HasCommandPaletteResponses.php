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

    public function alert(string $message): void
    {
        getCommandPalette()->responses[] = [
            'type' => 'alert',
            'data' => $message,
        ];
    }

    public function log(mixed $message): void
    {
        getCommandPalette()->responses[] = [
            'type' => 'log',
            'data' => $message,
        ];
    }

    public function sleep(int $ms = 0): void
    {
        getCommandPalette()->responses[] = [
            'type' => 'delay',
            'data' => $ms,
        ];
    }

    public function delay(int $ms = 0): void
    {
        $this->sleep($ms);
    }
}
