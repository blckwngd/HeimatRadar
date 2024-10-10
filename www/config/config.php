<?php

  define("MYSQL_USER", "");
  define("MYSQL_PASS", "");
  define("MYSQL_HOST", "localhost");
  define("MYSQL_DB", "");


  $languages = array(
    "de" => "Deutsch",
    "en" => "English"
  );

  $pdo = @mysqli_connect(
    MYSQL_HOST,
    MYSQL_USER,
    MYSQL_PASS,
    MYSQL_DB,
    3306,
    ini_get("mysqli.default_socket")
  );

  try {
    $pdo = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB, MYSQL_USER, MYSQL_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
      die("Connection failed: " . $e->getMessage());
  }

?>
