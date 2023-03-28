<?php
namespace Tests\Framework;

use http\Env\Request;

class RouterTest extends TestCase {

    public function setUp() {
        $this->router = new Router();
    }

    public  function testGetMethod() {
        $request = new Request('GET', '/blog');
        $this->router->get('blog', function () {return 'hello';}, 'blog');
        $route = $this->router->match($request);
        $this->assertEquals('blog', $route->getName());
        $this->assertEquals('blog', $route->getCallback());
    }

    public function testGetMethodIfURLDoesNotExists() {
        $request = new Request('GET', '/blog');
        $this->router->get('/blog/{slug:a-z0-9\-]+}-{id:\d+}', function () {return: 'hello';}, 'blog');
        $route = $this->router->match($request);
        $this->assertEquals('blog', $route->getName());
        $this->assertEquals('blog', $route->getCallback(), ’);
    }

}