<?php
// endpoints/option_functions.php
global $conn, $method;

$function_id = $_GET['function_id'] ?? null;
$option_id = $_GET['option_id'] ?? null;

switch ($method) {
    case 'GET':
        if ($function_id && $option_id) {
            $stmt = $conn->prepare("SELECT * FROM option_functions WHERE function_id = ? AND option_id = ?");
            $stmt->bind_param("ii", $function_id, $option_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
            $stmt->close();
        } else {
            $result = $conn->query("SELECT * FROM option_functions");
            $data = $result->fetch_all(MYSQLI_ASSOC);
        }
        echo json_encode($data);
        break;
    case 'POST':
        $input = json_decode(file_get_contents("php://input"), true);
        if (!isset($input['function_id'], $input['option_id'])) {
            http_response_code(400);
            echo json_encode(["message" => "Missing required fields"]);
            exit();
        }
        $stmt = $conn->prepare("INSERT INTO option_functions (function_id, option_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $input['function_id'], $input['option_id']);
        $stmt->execute();
        $stmt->close();
        echo json_encode(["message" => "Option function added successfully"]);
        break;
    case 'DELETE':
        if (!$function_id || !$option_id) {
            http_response_code(400);
            echo json_encode(["message" => "function_id and option_id are required"]);
            exit();
        }
        $stmt = $conn->prepare("DELETE FROM option_functions WHERE function_id = ? AND option_id = ?");
        $stmt->bind_param("ii", $function_id, $option_id);
        $stmt->execute();
        $stmt->close();
        echo json_encode(["message" => "Option function deleted successfully"]);
        break;
    case NULL:
        http_response_code(404);
        break;
    default:
        http_response_code(405);
        break;
}
