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
    
    // validiere Email
    if (strlen($input["email"]) > 100 || ((strlen($input["email"]) > 0) && !filter_var($input["email"], FILTER_VALIDATE_EMAIL))) {
      echo json_encode([
        'status' => 'error',
        'message' => "reg.inputEmail_hinweisUngueltig",
        'field' => 'email'
      ]);
      return;
    }

    // validiere Telefon
    if (strlen($input["phone"]) > 50) {
      echo json_encode([
        'status' => 'error',
        'message' => "reg.inputPhone_hinweisUngueltig",
        'field' => 'phone'
      ]);
      return;
    }
    
    // validiere Angebot
    if (strlen($input["angebot"]) >= 1024) {
      echo json_encode([
        'status' => 'error',
        'message' => "reg.inputAngebot_hinweisUngueltig",
        'field' => 'angebot'
      ]);
      return;
    }
    
    // validiere Anzahl
    $anzahl = intval($input["anzahl"]);
    if (($anzahl <= 0) || ($anzahl > MAX_HAUSHALTE_PRO_ADRESSE)) {
      echo json_encode([
        'status' => 'error',
        'message' => "reg.inputAnzahl_hinweisUngueltig",
        'field' => 'anzahl'
      ]);
      return;
    }
    
    // validiere Kommentar
    if (strlen($input["kommentar"]) >= 2048) {
      echo json_encode([
        'status' => 'error',
        'message' => "reg.inputAngebot_hinweisUngueltig",
        'field' => 'kommentar'
      ]);
      return;
    }
    
    // validiere Teilnahme Checkbox
    if (!isset($input["teilnahme"]) || ($input["teilnahme"] != "on")) {
      echo json_encode([
        'status' => 'error',
        'message' => "reg.inputTeilnahme_hinweisUngueltig",
        'field' => 'teilnahme'
      ]);
      return;
    }
    
    // validiere Datenschtz Checkbox
    if (!isset($input["datenschutz"]) || ($input["datenschutz"] != "on")) {
      echo json_encode([
        'status' => 'error',
        'message' => "reg.inputDatenschutz_hinweisUngueltig",
        'field' => 'datenschutz'
      ]);
      return;
    }

    $token = md5(md5(rand()) . rand());
    $sql = "INSERT INTO `".MYSQL_TABLE."` 
      (`name`, `strasse`, `hausnummer`, `telefon`, `email`, `teilnahme`, `datenschutz`, `anzahl`, `angebot`, `kommentar`, `token`) 
      VALUES (:name, :strasse, :hausnummer, :telefon, :email, :teilnahme, :datenschutz, :anzahl, :angebot, :kommentar, :token)";
    $stmt = $pdo->prepare($sql);
    var_dump($input);
    $stmt->execute([
      'name' => $input['name'],
      'strasse' => $input['strasse'],
      'hausnummer' => $input['hausnr'],
      'telefon' => $input['phone'],
      'email' => $input['email'],
      'teilnahme' => 1,
      'datenschutz' => 1,
      'anzahl' => $anzahl,
      'angebot' => $input['angebot'],
      'kommentar' => $input['kommentar'],
      'token' => $token
    ]);
    echo json_encode(['message' => 'User created successfully']);
    echo json_encode(['token' => $token]);
    echo json_encode(['status' => 'ok']);
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