<?php
  require_once("config.php");
  $result = mysqli_query($mysqli, "select id,lat,lon,strasse,anzahl,angebot,kommentar from hofflohmarkt where validiert=1 order by strasse ASC");
  
  $staende = array();
  while ($row = mysqli_fetch_assoc($result)) {
    array_push($staende, $row);
  }

  echo json_encode($staende);
?>