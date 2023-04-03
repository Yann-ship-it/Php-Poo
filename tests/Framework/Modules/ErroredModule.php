<?php

namespace Tests\Framework\Modules;

class ErroredModule
{
    public function __construct(\Framework\Router $router)
    {
        $router->get('/testt', function () {
            return new \stdClass();
        }, 'testt');
    }
}
