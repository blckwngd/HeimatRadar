<?php

$isApiAccess = !defined("HEIMATRADAR_INITIALIZED");
$input = false;

if ($isApiAccess) {
  header("Content-Type: application/json");
  require_once("config/config.php");
  $input = json_decode(file_get_contents('php://input'), true);
}

global $i18n, $isLoggedIn;

$method = $_SERVER['REQUEST_METHOD'];

if ($isApiAccess) {
  switch ($method) {
      case 'GET':
          handleGet($_GET);
          break;
      case 'POST':
          handlePost($_POST);
          break;
      case 'PUT':
          handlePut($input);
          break;
      case 'PATCH':
          handlePatch($input);
          break;
      case 'DELETE':
          handleDelete($input);
          break;
      default:
          echo json_encode(['message' => 'Invalid request method']);
          break;
  }
}

function verifyEntry ($id) {
  // TODO set to "validated"
  // TODO send confirmation mail
}

/** Geocoding with Google Maps API
 * 
 * taken from https://www.codeofaninja.com/google-maps-geocoding-example-php/#Step_4_Create_the_PHP_geocode_function
 */
function geocode($address){
  $address = urlencode($address);
  $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key=" . GOOGLE_MAPS_API_KEY;
  $resp_json = file_get_contents($url);
  $resp = json_decode($resp_json, true);
  if($resp['status']=='OK'){
      $lati = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
      $longi = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";
      $formatted_address = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : "";
      if($lati && $longi && $formatted_address){
          return array("OK", $lati, $longi, $formatted_address);
      } else {
          return false;
      }
  } else{
      return array("ERROR", $resp['status']);
  }
}

function getStaende() {
  global $isLoggedIn, $pdo;
  $sql = $isLoggedIn
    ? "select id,name,email,telefon,lat,lon,strasse,hausnummer,anzahl,angebot,kommentar,wannValidiert,wannErstellt from heimatradar order by strasse ASC"
    : "select id,lat,lon,strasse,hausnummer,anzahl,angebot from heimatradar where wannValidiert IS NOT NULL order by strasse ASC";
    $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $staende = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if ($isLoggedIn) {
    // fehlende Geokodierung ergänzen
    foreach ($staende as $i => $stand) {
      if (empty($stand["lat"]) || empty($stand["lon"])) {
        $address = $stand["strasse"] . " " . $stand["hausnummer"] . ", " . POSTLEITZAHL . " " . ORT;
        $result = geocode($address);
        if ($result[0] == "OK") {
          $sql = "UPDATE `".MYSQL_TABLE."` SET
            lat=:lat,
            lon=:lon
          WHERE id=:id";
          $stmt = $pdo->prepare($sql);
          $stmt->execute([
            'lat' => floatval($result[1]),
            'lon' => floatval($result[2]),
            'id' => $stand["id"]
          ]);
          $staende[$i]["lat"] = floatval($result[1]);
          $staende[$i]["lon"] = floatval($result[2]);
        }
      }
    }
  }

  return $staende;
}

function handleGet($input) {
    $staende = getStaende();

    echo json_encode($staende);
}

function handlePatch($input) {
  global $isLoggedIn, $pdo;
  if (!$isLoggedIn) {
    echo json_encode([
      'status' => 'ERROR',
      'message' => 'not logged in'
    ]);
    return;
  }
  switch ($input["action"]) {
    case "verify":
      $sql = "UPDATE `".MYSQL_TABLE."` SET
              wannValidiert=NOW()
            WHERE id=:id";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([
        'id' => $input["id"]
      ]);

      echo json_encode([
        'status' => 'OK',
        'message' => 'entry validated successfully'
      ]);
      break;
    case "unverify":
      $sql = "UPDATE `".MYSQL_TABLE."` SET
              wannValidiert=NULL
            WHERE id=:id";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([
        'id' => $input["id"]
      ]);

      echo json_encode([
        'status' => 'OK',
        'message' => 'entry withdrawn successfully'
      ]);
      break;
  }
}

function handlePost($input) {
    global $isLoggedIn, $pdo;

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
    if ($isLoggedIn && isset($input["validieren"]) && ($input["validieren"] == "on")) {
      return validateEntry($pdo->lastInsertId());
    }

    echo json_encode([
      'message' => 'success',
      'token' => $token,
      'status' => 'ok'
    ]);
}

function handlePut($input) {
    global $pdo;
    $sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => $input['name'], 'email' => $input['email'], 'id' => $input['id']]);
    echo json_encode(['message' => 'User updated successfully']);
}

function handleDelete($input) {
    global $pdo;
    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $input['id']]);
    echo json_encode(['message' => 'User deleted successfully']);
}

?>