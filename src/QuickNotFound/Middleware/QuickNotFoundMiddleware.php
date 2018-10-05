<?php

namespace A3020\QuickNotFound\Middleware;

use Concrete\Core\Application\ApplicationAwareInterface;
use Concrete\Core\Application\ApplicationAwareTrait;
use Concrete\Core\Http\Middleware\DelegateInterface;
use Concrete\Core\Http\Middleware\MiddlewareInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class QuickNotFoundMiddleware implements MiddlewareInterface, ApplicationAwareInterface
{
    use ApplicationAwareTrait;

    public function process(Request $request, DelegateInterface $frame)
    {
        if ($this->shouldReturnNotFound($request)) {
            return new Response('File Not Found', Response::HTTP_NOT_FOUND);
        }

        /** @var Response $response */
        $response = $frame->next($request);

        return $response;
    }

    /**
     * Return true if a 404 response should be sent.
     *
     * @param Request $request
     *
     * @return bool
     */
    private function shouldReturnNotFound(Request $request)
    {
        // This is for local environments only, for more information about environments
        // check the tutorial: https://documentation.concrete5.org/tutorials/loading-configuration-based-host-and-environment
        if (!$this->app->environment('local')) {
            return false;
        }

        $requestUri = strtolower($request->getRequestUri());

        // Check if the user tries to access a file.
        if (strpos($requestUri, 'application/files') === false) {
            return false;
        }

        // Return 404 if the file doesn't exist.
        return !file_exists($requestUri);
    }
}
