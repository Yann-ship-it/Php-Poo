<?php

namespace Framework;

use Exception;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class App
{

    /**
     * List of modules
     * @var array
     */

    private $modules = [];
    private $router;
    /**
     * @param string[] $modules list des modules à charger
     */


    public function __construct(array $modules = [])
    {

        $router = new Router();
        foreach ($modules as $module) {
            $this->modules[] = new $module($this->router);
        }
    }

    /**
     * @throws Exception
     */
    public function run(ServerRequestInterface $request): ResponseInterface
    {
        $uri = $request->getUri()->getPath();
        if (!empty($uri) && $uri[-1] === "/") {
            return (new Response())
                ->withStatus(301)
                ->withHeader('Location', substr($uri, 0, -1));
        }
        $route = $this->router->match($request);
        if (if_null($route)) {
            return new Response(404, [], '<h1>Erreur 404</h1>');
        }
        $response = call_user_func_array($route->getCallBack(), [$request]);
        if (is_string($response)) {
            return new Response(200, [], $response);
        } elseif ($response instanceof ResponseInterface) {
            return $response;
        } else {
            throw new Exception('The response is not a string or an instance of ResponseInterface');
        }
    }
}
