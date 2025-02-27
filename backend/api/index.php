<?php

require './config/config.php';
require './config/db.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uriParts = explode('/', $uri);

$endpoint = $uriParts[2] ?? '';
$method = $_SERVER['REQUEST_METHOD'];
$id = $_GET['id'] ?? null;

$endpointFile = __DIR__ . '/endpoints/' . strtolower($endpoint) . '.php';

if (file_exists($endpointFile)) {
    require $endpointFile;
} else {
    http_response_code(404);
    echo json_encode(["message" => "Endpoint not found"]);
}
?>
