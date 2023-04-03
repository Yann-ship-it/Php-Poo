<?php
namespace Tests\Framework;

use App\Blog\BlogModule;
use Framework\App;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;
use Tests\Framework\Modules\ErroredModule;

class AppTest extends TestCase
{

    public function testRedirectTrailingSlash()
    {
        $app = new App();
        $request = new ServerRequest('GET', '/test/');
        $response = $app->run($request);
        $this->assertContains('/test', $response->getHeader('Location'));
        $this->assertEquals(301, $response->getStatusCode());
    }

    public function testBlog()
    {
        $app = new App([
            BlogModule::class
        ]);
        $request = new ServerRequest('GET', '/blog');
        $response = $app->run($request);
        $this->assertStringContainsString('<h1>Bienvenue sur le blog</h1>', (string)$response->getBody());
        $this->assertEquals(200, $response->getStatusCode());

        $requestSingle = new ServerRequest('GET', '/blog/article-de-test');
        $responseSingle = app->run($request);
        $this->assertContains('<h1>Bienvenue sur l\'article' . $request->getAttribute('slug') . '</h1>', (string)$responseSingle->getBody());
    }

    public function testThrowExceptionIfNfoResponseSent()
    {
        $app = new App([
            ErroredModule::class
        ]);
        $request = new ServerRequest('GET', '/testt');
        $this->expectException(\Exception::class);
        $app->run($request);
    }

    public function testError404()
    {
        $app = new App();
        $request = new ServerRequest('GET', '/ezez');
        $response = $app->run($request);
        $this->assertStringContainsString('<h1>Erreur 404</h1>', (string)$response->getBody());
        $this->assertEquals(404, $response->getStatusCode());
    }
}
