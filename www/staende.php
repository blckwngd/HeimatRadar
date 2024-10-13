<?php

header("Content-Type: application/json");
include("config/config.php");

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'GET':
        handleGet($pdo, $_GET);
        break;
    case 'POST':
        handlePost($pdo, $_POST);
        break;
    case 'PUT':
        handlePut($pdo, $input);
        break;
    case 'DELETE':
        handleDelete($pdo, $input);
        break;
    default:
        echo json_encode(['message' => 'Invalid request method']);
        break;
}

function handleGet($pdo, $input) {
    $sql = "select id,lat,lon,strasse,anzahl,angebot,kommentar from heimatradar where wannValidiert IS NOT NULL order by strasse ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
}

function handlePost($pdo, $input) {

    // validiere Name
    if (strlen($input["name"]) > 100) {
      echo json_encode([
        'status' => 'error',
        'message' => "reg.inputName_hinweisUngueltig",
        'field' => 'name'
      ]);
      return;
    }
    
    // validiere Straße
    if (empty($input["strasse"]) || strlen($input["strasse"]) > 50) {
      echo json_encode([
        'status' => 'error',
        'message' => "reg.inputStrasse_hinweisUngueltig",
        'field' => 'strasse'
      ]);
      return;
    }
    
    // validiere Hausnummer
    if (empty($input["hausnr"]) || strlen($input["hausnr"]) > 10) {
      echo json_encode([
        'status' => 'error',
        'message' => "reg.inputHausnr_hinweisUngueltig",
        'field' => 'hausnr'
      ]);
      return;
    }

    echo json_encode(['status' => 'ok']);
    /*
    $sql = "INSERT INTO users (name, email) VALUES (:name, :email)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => $input['name'], 'email' => $input['email']]);
    echo json_encode(['message' => 'User created successfully']);*/
}

function handlePut($pdo, $input) {
    $sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => $input['name'], 'email' => $input['email'], 'id' => $input['id']]);
    echo json_encode(['message' => 'User updated successfully']);
}

function handleDelete($pdo, $input) {
    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $input['id']]);
    echo json_encode(['message' => 'User deleted successfully']);
}

?>