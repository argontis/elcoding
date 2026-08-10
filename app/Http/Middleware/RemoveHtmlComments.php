<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RemoveHtmlComments
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($this->isHtmlResponse($response)) {
            $content = $response->getContent();
            // Remove all HTML comments (except IE conditionals if any exist, but modern apps don't need them)
            $content = preg_replace('/<!--(.*?)-->/s', '', $content);
            $response->setContent($content);
        }

        return $response;
    }

    protected function isHtmlResponse(Response $response): bool
    {
        $contentType = $response->headers->get('Content-Type');
        return $contentType && str_contains(strtolower($contentType), 'text/html');
    }
}
