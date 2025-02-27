<?php
// index.php
require './config/config.php';
require './config/db.php';

// Parse the request URL. For example, a request to /api/campaign loads endpoints/campaign.php.
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uriParts = explode('/', $uri);

// Assuming your API is under /api, the endpoint is at index 2.
$endpoint = $uriParts[2] ?? '';
$method = $_SERVER['REQUEST_METHOD'];
$id = $_GET['id'] ?? null;

$endpointFile = __DIR__ . '/api/' . strtolower($endpoint) . '.php';

if (file_exists($endpointFile)) {
    require $endpointFile;
} else {
    http_response_code(404);
    echo json_encode(["message" => "Endpoint not found"]);
}
?>
