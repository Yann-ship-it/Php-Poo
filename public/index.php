<?php

use App\Blog\BlogModule;
use GuzzleHttp\Psr7\ServerRequest;
use function Http\Response\send;

require '../vendor/autoload.php';

$app = new Framework\App([
    BlogModule::class
]);

$response = $app->run(ServerRequest::fromGlobals());
send($response);
