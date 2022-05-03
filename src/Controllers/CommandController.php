<?php

namespace IsaEken\LaravelCommandPalette\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use function response;

class CommandController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = $request->input('query');
        $commands = getCommandPalette()->getCommands();

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

    public function execute(string $id): JsonResponse
    {
        getCommandPalette()->execute($id);
        return response()->json(getCommandPalette()->responses);
    }
}