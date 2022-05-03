<?php

namespace IsaEken\LaravelCommandPalette\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use IsaEken\LaravelCommandPalette\Contracts\Command;
use IsaEken\LaravelCommandPalette\Contracts\Resource;
use IsaEken\LaravelCommandPalette\Enums\Icon;
use function response;

class CommandController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = $request->input('query');
        $commands = getCommandPalette()->getCommands()->map(function (Command $command) {
            return [
                'id' => $command->getId(),
                'groupId' => $command->getGroupId(),
                'name' => $command->getName(),
                'description' => $command->getDescription(),
                'arguments' => $command instanceof Resource ? ['id' => $command->getItemId()] : null,
                'icon' =>
                    $command->getIcon() instanceof Icon
                        ? $command->getIcon()->toIconName()
                        : $command->getIcon(),
            ];
        });

        if (strlen($query) > 0) {
            $commands = $commands->filter(function ($item) use ($query) {
                return false !== stristr($item['name'], $query);
            });
        }

        return response()->json([
            'commands' => $commands,
            'groups' => config('command-palette.groups', []),
            'grouped' => $commands->groupBy('groupId'),
        ]);
    }

    public function execute(Request $request, string $id): JsonResponse
    {
        getCommandPalette()->execute($id, $request->all());

        return response()->json(getCommandPalette()->responses);
    }
}
