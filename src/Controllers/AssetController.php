<?php

namespace IsaEken\LaravelCommandPalette\Controllers;

use DateTime;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class AssetController extends Controller
{
    public function css(): Response
    {
        $filename = __DIR__.'/../../dist/css/app.css';
        abort_unless(file_exists($filename), 404);
        $content = file_get_contents($filename);
        return $this->cacheResponse(new Response($content, 200, ['Content-Type' => 'text/css']));
    }

    public function js(): Response
    {
        $filename = __DIR__.'/../../dist/js/app.js';
        abort_unless(file_exists($filename), 404);
        $content = file_get_contents($filename);
        return $this->cacheResponse(new Response($content, 200, ['Content-Type' => 'text/javascript']));
    }

    protected function cacheResponse(Response $response): Response
    {
        if (app()->environment() === 'production') {
            $response->setSharedMaxAge(31536000);
            $response->setMaxAge(31536000);
            $response->setExpires(new DateTime('+1 year'));
        }

        return $response;
    }
}