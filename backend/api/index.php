<?php
header("Content-Type: application/json");
require __DIR__ . '/config/config.php';
require __DIR__ . '/config/db.php';

// Define the filesystem path for including files
$baseFolder = __DIR__;

// Define the base URL path (adjust as needed)
$baseUri = '/VisualNova/backend/api/';

// Remove the base URL from the request URI
$uri = str_replace($baseUri, '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$uriParts = array_values(array_filter(explode('/', $uri)));

$endpoint = $uriParts[0] ?? ''; // Get endpoint (e.g., 'campaign')
$method = $_SERVER['REQUEST_METHOD'] ?? 'UNKNOWN';
$id = $_GET['id'] ?? null;

// Build the endpoint file path
$endpointFile = $baseFolder . '/endpoints/' . strtolower($endpoint) . '.php';

/* Debugging Output (Remove in production)
var_dump("\nBaseFolder: " . $baseFolder);
var_dump("\nuri: " . $uri);
var_dump("\nuriParts: ");
var_dump($uriParts);
var_dump("\nendpoint: " . $endpoint);
var_dump("\nmethod: " . $method);
var_dump("\nid: " . $id);
var_dump("\nendpointFile: " . $endpointFile);
*/
if (file_exists($endpointFile)) {
    require $endpointFile;
} else {
    http_response_code(404);
    echo json_encode(["message" => "Endpoint not found"]);
}
?>
