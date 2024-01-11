<?php

  define("MYSQL_USER", "");
  define("MYSQL_PASS", "");
  define("MYSQL_HOST", "");
  define("MYSQL_DB", "");
  $mysqli = mysqli_connect(
    MYSQL_HOST,
    MYSQL_USER,
    MYSQL_PASS,
    MYSQL_DB,
    3306,
    ini_get("mysqli.default_socket")
  );

?>