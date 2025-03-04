<?php 
$uri = $_SERVER["REQUEST_URI"];

function allow_only($endpoint) {
    if($uri != $endpoint) {
        http_response_code(404);
        exit();
    }
}

allow_only("/backend/api/");

?>