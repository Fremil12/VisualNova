<?php
// endpoints/room.php
global $conn, $method, $id;

switch ($method) {
    case 'GET':
        if ($id) {
            $stmt = $conn->prepare("SELECT * FROM room WHERE campaign_id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
            $stmt->close();
        } else {
            $result = $conn->query("SELECT * FROM room");
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
        $stmt = $conn->prepare("INSERT INTO room (campaign_id, room_background, room_image, room_text, isFirst) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iiisi", $input['campaign_id'], $input['room_background'], $input['room_image'], $input['room_text'], $input['isFirst']);
        $stmt->execute();
        $lastId = $conn->insert_id;
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
        $stmt = $conn->prepare("UPDATE room SET campaign_id = ?, room_background = ?, room_image = ?, room_text = ?, isFirst = ? WHERE id = ?");
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
        $stmt = $conn->prepare("DELETE FROM room WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        echo json_encode(["message" => "Room deleted successfully"]);
        break;
    case NULL:
        http_response_code(404);
        break;
    default:
        http_response_code(405);
        break;
}
