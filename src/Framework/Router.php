<?php
namespace Framework;

use Psr\Http\Message\ServerRequestInterface;

/**
 * @package Framework;
 */
class Router {

    /**
     * @param string $path
     * @param callable $callable
     * @param string $name
     */
    public function get(string $path, callable $callable, string $name) {

    }

    /**
     * @param ServerRequestInterface $request
     */

    public function match(ServerRequestInterface $request) {

    }
}