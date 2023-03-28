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
        $this->router->get('/blogz', function () {return 'hello'; }, 'blog');
        $route = this->router->match($request);
        $this->assertEquals(null, $route);

    }
    public function testGetMethodWithParameters() {
        $request = new Request('GET', 'blog/slug-8');
        $this->router->get('/blog', function () {return 'dfghjuik'; }, 'posts');
        $this->router->get('/blog/{slug:a-z0-9\-]+}-{id:\d+}', function () {return 'hello'; }, 'post.show');
        $route = $this->router->match($request);
        $this->assertEquals('post.show', $route->getName());
        $this->assertEquals('hello', call_user_func_array($route->getCallback(), [$request]));
        $this->assertEquals(['slug' => 'slug' => 'id' => '8'], $route->getParameters);
    }
}