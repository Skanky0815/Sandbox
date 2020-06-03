<?php

require_once('../vendor/autoload.php');

/** @var array<string, string|bool|int|float|null> $post */
$post = json_decode(file_get_contents("php://input"), true);

$request = new \Wizmo\Request($post);

$pipe = new \Wizmo\Pipeline(
    function (\Wizmo\Request $request): \Wizmo\Request {
        $name = $request->get('name');
        if (is_numeric($name)) {
            throw new Exception("name must be a string!");
        }

        return $request;
    },
    new \Wizmo\Pipeline\Trim,
    new \Wizmo\Pipeline\SetNullIfEmpty,
    new \Wizmo\Pipeline\ClearNulls,
    new \Wizmo\Pipeline\Required(['name']),
    new \Wizmo\Pipeline\MinLength(3, ['name']),
    function (\Wizmo\Request $request): \Wizmo\Request {
        $name = $request->get('name');
        $request->set('name', $name . ' San');

        return $request;
    }
);

$response = new \Wizmo\Response();
try {
    $request = $pipe->process($request);
    $sandbox = new \Wizmo\Sandbox();

    $response->send(['greeting' => $sandbox->run($request->get('name'))]);
} catch (Exception $e) {
    $response->send(['message' => $e->getMessage()], \Wizmo\Response::HTTP_BAD_REQUEST);
}
