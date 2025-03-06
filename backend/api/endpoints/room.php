<?php
// endpoints/room.php
global $mysqli, $method, $id;

switch ($method) {
    case 'GET':
        if ($id) {
            $stmt = $mysqli->prepare("SELECT * FROM room WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
            $stmt->close();
        } else {
            $result = $mysqli->query("SELECT * FROM room");
            $data = $result->fetch_all(MYSQLI_ASSOC);
        }
        echo json_encode($data);
        break;
    case 'POST':
        $input = json_decode(file_get_contents("php://input"), true);
        if (!isset($input['campaign_id'], $input['room_background'], $input['room_image'], $input['room_text'], $input['isFirst'])) {
            http_response_code(400);
            echo json_encode(["message" => "Missing required fields"]);
            exit();
        }
        $stmt = $mysqli->prepare("INSERT INTO room (campaign_id, room_background, room_image, room_text, isFirst) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iiisi", $input['campaign_id'], $input['room_background'], $input['room_image'], $input['room_text'], $input['isFirst']);
        $stmt->execute();
        $lastId = $mysqli->insert_id;
        $stmt->close();
        echo json_encode(["message" => "Room created successfully", "id" => $lastId]);
        break;
    case 'PUT':
        if (!$id) {
            http_response_code(400);
            echo json_encode(["message" => "ID required"]);
            exit();
        }
        $input = json_decode(file_get_contents("php://input"), true);
        $stmt = $mysqli->prepare("UPDATE room SET campaign_id = ?, room_background = ?, room_image = ?, room_text = ?, isFirst = ? WHERE id = ?");
        $stmt->bind_param("iiisii", $input['campaign_id'], $input['room_background'], $input['room_image'], $input['room_text'], $input['isFirst'], $id);
        $stmt->execute();
        $stmt->close();
        echo json_encode(["message" => "Room updated successfully"]);
        break;
    case 'DELETE':
        if (!$id) {
            http_response_code(400);
            echo json_encode(["message" => "ID required"]);
            exit();
        }
        $stmt = $mysqli->prepare("DELETE FROM room WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        echo json_encode(["message" => "Room deleted successfully"]);
        break;
    default:
        http_response_code(405);
        echo json_encode(["message" => "Method not allowed"]);
        echo json_encode(["message" => $method]);
        break;
}
