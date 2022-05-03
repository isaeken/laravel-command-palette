<?php

namespace IsaEken\LaravelCommandPalette\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use function response;

class DataController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return response()->json([
            'tips' => config('command-palette.tips', []),
        ]);
    }
}
