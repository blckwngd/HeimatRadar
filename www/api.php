<?php
  header("Content-Type: application/json");
  include("config/config.php");
  /*
  $result = mysqli_query($mysqli, "select id,lat,lon,strasse,anzahl,angebot,kommentar from hofflohmarkt where validiert=1 order by strasse ASC");
  
  $staende = array();
  while ($row = mysqli_fetch_assoc($result)) {
    array_push($staende, $row);
  }

  echo json_encode($staende);
*/
$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);


switch ($method) {
    case 'GET':
        handleGet($pdo, $_GET);
        break;
    case 'POST':
        handlePost($pdo, $input);
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
  switch (@$input["what"]) {
    case "staende":
      $sql = "select id,lat,lon,strasse,anzahl,angebot,kommentar from heimatradar where wannValidiert IS NOT NULL order by strasse ASC";
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      echo json_encode($result);
      break;
    default:
      echo json_encode(['message' => 'Invalid request']);
      break;
  }
}

function handlePost($pdo, $input) {
    $sql = "INSERT INTO users (name, email) VALUES (:name, :email)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => $input['name'], 'email' => $input['email']]);
    echo json_encode(['message' => 'User created successfully']);
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