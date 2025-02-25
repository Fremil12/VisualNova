<?php

header("Content-Type: application/json");
require './config/db.php';

// Get the HTTP request method
$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case "GET": // Fetch all users
        handleGet($conn);
        break;

    case "POST": // Insert a new user
        handlePost($conn, $input);
        break;

    case "PUT": // Update user
        handlePut($conn, $input);
        break;

    case "DELETE": // Delete user
        handleDelete($conn, $input);
        break;

    default:
        echo json_encode(["error" => "Invalid request"]);
        break;
}


function handleGet($conn)
{
    $sql = "";
    $result = $conn->query($sql);
    $resp = array();

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $resp[] = array("id" => $row["id"], "nev" => $row["nev"], "sor" => $row["sor"], "oszlop" => $row["oszlop"]);
        }
    }
    echo json_encode($resp);
};

function handlePost($conn, $input)
{
    $sql = "";
    $stmt = $conn->prepare($sql);
    $stmt->bind_params("sii",$input["nev"],$input["sor"],$input["oszlop"]);
    $stmt->execute();
    if ($stmt) {
        echo json_encode(["message" => "Data inserted successfully"]);
    } else {
        echo json_encode(["error" => "Error inserting data"]);
    }
};

function handlePut($conn, $input)
{
    $sql = "";
    $stmt = $conn->prepare($sql);
    $stmt->bind_params("sii",$input["nev"],$input["id"]);
    $stmt->execute();
    if ($stmt) {
        echo json_encode(["message" => "User updated successfully"]);
    } else {
        echo json_encode(["error" => "Error updating user"]);
    }
};

function handleDelete($conn, $input)
{
    $sql = "";
    $stmt = $conn->prepare($sql);
    $stmt->bind_params("sii",$input["id"]);
    $stmt->execute();
    $result = $stmt->affected_row();
    if ($result) {
        echo json_encode(["message" => "User deleted successfully"]);
    } else {
        header("HTTP/1.1 404 not found");
        echo json_encode(["error" => "Error deleting user"]);
    }
};
