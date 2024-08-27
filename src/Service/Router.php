<?php

namespace App\Service;

class Router
{
    private $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function dispatch($requestMethod, $requestUri)
    {
        $requestUri = parse_url($requestUri, PHP_URL_PATH);

        foreach ($this->routes as $route => $action) {
            list($method, $routePattern) = explode(' ', $route, 2);

            // Check if the request method matches
            if ($requestMethod !== $method) {
                continue;
            }

            // Replace route parameters (e.g., {region}) with regex patterns
            $routePattern = preg_replace('/{[^}]+}/', '([^/]+)', $routePattern);
            $routePattern = str_replace('/', '\/', $routePattern);

            // Check if the request URI matches the route pattern
            if (preg_match('/^' . $routePattern . '$/', $requestUri, $matches)) {
                array_shift($matches); // Remove the full match from the start

                // Debugging: Log the route and the matches
                error_log('Route pattern: ' . $routePattern);
                error_log('Matches: ' . print_r($matches, true));

                // Call the controller method and pass the captured parameters
                return call_user_func_array([new $action[0], $action[1]], $matches);
            }
        }

        // Return a 404 response if no route matches
        http_response_code(404);
        return json_encode(['error' => 'Not Found']);
    }
}
