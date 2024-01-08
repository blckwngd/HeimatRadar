<?php
  $mysqli = mysqli_connect(
    "MYSQL_SERVER",
    "MYSQL_USER",
    "MYSQL_PASS",
    "MYSQL_DB",
    3306,
    ini_get("mysqli.default_socket")
  );
  $result = mysqli_query($mysqli, "select id,lat,lon,strasse,anzahl,angebot,kommentar from hofflohmarkt where validiert=1 order by strasse ASC");
  
  $staende = array();
  while ($row = mysqli_fetch_assoc($result)) {
    array_push($staende, $row);
  }
  
  echo json_encode($staende);
?>