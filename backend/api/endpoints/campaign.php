<?php
global $conn, $method, $id;

switch($method) {
    case 'GET':
        if ($id) {
            $stmt = $conn->prepare("SELECT * FROM campaign WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
        } else {
            $result = $conn->query("SELECT * FROM campaign");
            $data = $result->fetch_all(MYSQLI_ASSOC);
        }
        echo json_encode($data);
        break;
    case 'POST':
        $input = json_decode(file_get_contents("php://input"), true);
        if (!isset($input['campaign_name'], $input['campaign_version'], $input['campaign_description'], $input['campaign_image'], $input['campaign_creator_id'])) {
            http_response_code(400);
            echo json_encode(["message" => "Missing required fields"]);
            exit();
        }
        $stmt = $conn->prepare("INSERT INTO campaign (campaign_name, campaign_version, campaign_description, campaign_image, campaign_creator_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssii", $input['campaign_name'], $input['campaign_version'], $input['campaign_description'], $input['campaign_image'], $input['campaign_creator_id']);
        $stmt->execute();
        $lastId = $conn->insert_id;
        $stmt->close();
        echo json_encode(["message" => "Campaign created successfully", "id" => $lastId]);
        break;
    case 'PUT':
        if (!$id) {
            http_response_code(400);
            echo json_encode(["message" => "ID required"]);
            exit();
        }
        $input = json_decode(file_get_contents("php://input"), true);
        $stmt = $conn->prepare("UPDATE campaign SET campaign_name = ?, campaign_version = ?, campaign_description = ?, campaign_image = ?, campaign_creator_id = ? WHERE id = ?");
        $stmt->bind_param("sssiii", $input['campaign_name'], $input['campaign_version'], $input['campaign_description'], $input['campaign_image'], $input['campaign_creator_id'], $id);
        $stmt->execute();
        $stmt->close();
        echo json_encode(["message" => "Campaign updated successfully"]);
        break;
    case 'DELETE':
        if (!$id) {
            http_response_code(400);
            echo json_encode(["message" => "ID required"]);
            exit();
        }
        $stmt = $conn->prepare("DELETE FROM campaign WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        echo json_encode(["message" => "Campaign deleted successfully"]);
        break;
    case NULL:
        http_response_code(404);
        break;
    default:
        http_response_code(405);
        break;
}
