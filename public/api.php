<?php

require_once('../vendor/autoload.php');

$_POST = json_decode(file_get_contents("php://input"), true);

$name = $_POST['name'] ?: null;

$sandbox = new \Wizmo\Sandbox();

echo json_encode(['greeting' => $sandbox->run($name)]);
