<?php

use App\Pipeline;
use App\Pipeline\ClearNulls;
use App\Pipeline\MinLength;
use App\Pipeline\Required;
use App\Pipeline\SetNullIfEmpty;
use App\Pipeline\Trim;
use App\Request;
use App\Response;
use App\Sandbox;

require_once('../vendor/autoload.php');

/** @var array<string, string|bool|int|float|null> $post */
$post = json_decode(file_get_contents("php://input"), true);

$request = new Request($post);

$pipe = new Pipeline(
    function (Request $request): Request {
        $name = $request->get('name');
        if (is_numeric($name)) {
            throw new Exception("name must be a string!");
        }

        return $request;
    },
    new Trim,
    new SetNullIfEmpty,
    new ClearNulls,
    new Required(['name']),
    new MinLength(3, ['name']),
    function (Request $request): Request {
        $name = $request->get('name');
        $request->set('name', $name . ' San');

        return $request;
    }
);

$response = new Response();
try {
    $request = $pipe->process($request);
    $sandbox = new Sandbox();

    $response->send(['greeting' => $sandbox->run($request->get('name'))]);
} catch (Exception $e) {
    $response->send(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
}
