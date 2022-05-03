<?php

namespace IsaEken\LaravelCommandPalette\Middleware;

use Closure;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Request;

class InjectCommandPalette
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        /** @var Response $response */
        $response = $next($request);
        $this->modifyResponse($request, $response);

        return $response;
    }

    /**
     * @param  Request  $request
     * @return bool
     */
    protected function isJsonRequest(Request $request): bool
    {
        // If XmlHttpRequest or Live, return true
        if ($request->isXmlHttpRequest() || $request->headers->get('X-Livewire')) {
            return true;
        }

        // Check if the request wants Json
        $acceptable = $request->getAcceptableContentTypes();

        return (isset($acceptable[0]) && $acceptable[0] == 'application/json');
    }

    /**
     * @param  Request  $request
     * @param $response
     * @return Response|mixed
     */
    public function modifyResponse(Request $request, $response): mixed
    {
        if (
            isset($response->exception) ||
            $response->isRedirection() ||
            $this->isJsonRequest($request) ||
            $response->headers->has('Content-Type') &&
            (! str_contains($response->headers->get('Content-Type'), 'html')) ||
            $request->getRequestFormat() !== 'html' ||
            $response->getContent() === false
        ) {
            return $response;
        }

        $this->inject($response);

        return $response;
    }

    public function inject($response): void
    {
        $content = $response->getContent();

        $head = getCommandPalette()->renderHead();
        $widget = getCommandPalette()->renderComponent();

        $pos = strripos($content, '</head>');
        if (false !== $pos) {
            $content = substr($content, 0, $pos).$head.substr($content, $pos);
        } else {
            $widget = $head.$widget;
        }

        $pos = strripos($content, '</body>');
        if (false !== $pos) {
            $content = substr($content, 0, $pos).$widget.substr($content, $pos);
        } else {
            $content = $content.$widget;
        }

        $original = null;
        if ($response instanceof Response && $response->getOriginalContent()) {
            $original = $response->getOriginalContent();
        }

        $response->setContent($content);
        $response->headers->remove('Content-Length');

        if ($original) {
            $response->original = $original;
        }
    }
}
