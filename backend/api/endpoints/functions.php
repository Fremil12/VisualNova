<?php
// endpoints/functions.php
global $conn, $method, $id;

switch ($method) {
    case 'GET':
        if ($id) {
            $stmt = $conn->prepare("SELECT * FROM functions WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
        } else {
            $result = $conn->query("SELECT * FROM functions");
            $data = $result->fetch_all(MYSQLI_ASSOC);
        }
        echo json_encode($data);
        break;
    case 'POST':
        $input = json_decode(file_get_contents("php://input"), true);
        if (!isset($input['functionName'], $input['param'])) {
            http_response_code(400);
            echo json_encode(["message" => "Missing required fields"]);
            exit();
        }
        $stmt = $conn->prepare("INSERT INTO functions (functionName, param) VALUES (?, ?)");
        $stmt->bind_param("ss", $input['functionName'], $input['param']);
        $stmt->execute();
        $lastId = $conn->insert_id;
        $stmt->close();
        echo json_encode(["message" => "Function created successfully", "id" => $lastId]);
        break;
    case 'PUT':
        if (!$id) {
            http_response_code(400);
            echo json_encode(["message" => "ID required"]);
            exit();
        }
        $input = json_decode(file_get_contents("php://input"), true);
        $stmt = $conn->prepare("UPDATE functions SET functionName = ?, param = ? WHERE id = ?");
        $stmt->bind_param("ssi", $input['functionName'], $input['param'], $id);
        $stmt->execute();
        $stmt->close();
        echo json_encode(["message" => "Function updated successfully"]);
        break;
    case 'DELETE':
        if (!$id) {
            http_response_code(400);
            echo json_encode(["message" => "ID required"]);
            exit();
        }
        $stmt = $conn->prepare("DELETE FROM functions WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        echo json_encode(["message" => "Function deleted successfully"]);
        break;
    case NULL:
        http_response_code(404);
        break;
    default:
        http_response_code(405);
        break;
}
