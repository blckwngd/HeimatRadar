<?php

  define("MYSQL_USER", "root");
  define("MYSQL_PASS", "");
  define("MYSQL_HOST", "localhost");
  define("MYSQL_DB", "test");
  define("MYSQL_TABLE", "heimatradar");
  define("ADMIN_USER", "admin");
  define("ADMIN_PASS", "Pass123");
  define("API_SECRET", "hgfhj2d94x3TsMycgdG4Sxck");
  define("GOOGLE_MAPS_API_KEY", "AIzaSyD03t0MxCm2i3OG8Ve54h60i45RfUIEgQ8");

  /** Postleitzahl und Ort, an dem sich alle Stände befinden */
  define("POSTLEITZAHL", "56566");
  define("ORT", "Heimbach-Weis");

  // wie viele Stände können maximal an einer Adresse registriert werden?
  define("MAX_HAUSHALTE_PRO_ADRESSE", 10);

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

  $i18n = json_decode(file_get_contents("i18n/de.json"));

  session_start();
  $isLoggedIn = ((isset($_SESSION["API_SECRET"])) && $_SESSION["API_SECRET"] == API_SECRET);

  define("HEIMATRADAR_INITIALIZED", true);
  
?>
