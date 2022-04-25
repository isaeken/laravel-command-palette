<?php

namespace IsaEken\LaravelCommandPalette;

class CommandPalette
{
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

    public function renderWidget(): string
    {
        return file_get_contents(__DIR__.'/../resources/views/widget.html');
    }
}