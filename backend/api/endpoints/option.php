<?php

global $mysqli, $method, $id;

switch($method) {
    case 'GET':
        if ($id) {
            $stmt = $mysqli->prepare("SELECT * FROM `option` WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
            $stmt->close();
        } else {
            $result = $mysqli->query("SELECT * FROM `option`");
            $data = $result->fetch_all(MYSQLI_ASSOC);
        }
        echo json_encode($data);
        break;
    case 'POST':
        $input = json_decode(file_get_contents("php://input"), true);
        if (!isset($input['room_id'], $input['text'], $input['next_room_id'])) {
            http_response_code(400);
            echo json_encode(["message" => "Missing required fields"]);
            exit();
        }
        $stmt = $mysqli->prepare("INSERT INTO `option` (room_id, text, next_room_id) VALUES (?, ?, ?)");
        $stmt->bind_param("isi", $input['room_id'], $input['text'], $input['next_room_id']);
        $stmt->execute();
        $lastId = $mysqli->insert_id;
        $stmt->close();
        echo json_encode(["message" => "Option created successfully", "id" => $lastId]);
        break;
    case 'PUT':
        if (!$id) {
            http_response_code(400);
            echo json_encode(["message" => "ID required"]);
            exit();
        }
        $input = json_decode(file_get_contents("php://input"), true);
        $stmt = $mysqli->prepare("UPDATE `option` SET room_id = ?, text = ?, next_room_id = ? WHERE id = ?");
        $stmt->bind_param("isii", $input['room_id'], $input['text'], $input['next_room_id'], $id);
        $stmt->execute();
        $stmt->close();
        echo json_encode(["message" => "Option updated successfully"]);
        break;
    case 'DELETE':
        if (!$id) {
            http_response_code(400);
            echo json_encode(["message" => "ID required"]);
            exit();
        }
        $stmt = $mysqli->prepare("DELETE FROM `option` WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        echo json_encode(["message" => "Option deleted successfully"]);
        break;
    default:
        http_response_code(405);
        echo json_encode(["message" => "Method not allowed"]);
        break;
}
?>
