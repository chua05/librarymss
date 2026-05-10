<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

try {
    $request = \Illuminate\Http\Request::create('http://localhost/login', 'GET');
    $response = $kernel->handle($request);

    echo 'status=' . $response->getStatusCode() . PHP_EOL;
    $content = method_exists($response, 'getContent') ? (string) $response->getContent() : '';
    if ($content !== '') {
        echo 'content_snippet=' . substr($content, 0, 200) . PHP_EOL;
    }
} catch (\Throwable $e) {
    echo 'exception=' . get_class($e) . ': ' . $e->getMessage() . PHP_EOL;
    echo $e->getTraceAsString() . PHP_EOL;
}

