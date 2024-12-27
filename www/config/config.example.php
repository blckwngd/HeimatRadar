<?php

  /** MYSQL Zugangsdaten */
  define("MYSQL_USER", "");
  define("MYSQL_PASS", "");
  
  /** MYSQL Server Adresse und Port*/
  define("MYSQL_HOST", "localhost");
  define("MYSQL_PORT", 3306);

  /** MYSQL Datenbank und Tabelle */
  define("MYSQL_DB", "test");
  define("MYSQL_TABLE", "heimatradar");

  /** Benutzername und Passwort für administrative Arbeiten */
  define("ADMIN_USER", "admin");
  define("ADMIN_PASS", "");

  /** Setze hier eine sichere, lange Zeichenkette, mit der API-Anfragen authentifiziert werden.  */
  define("API_SECRET", "");

  /** Key für Geocoding per Google API: https://console.cloud.google.com/apis/credentials */
  define("GOOGLE_MAPS_API_KEY", "YOUR_GOOGLE_MAPS_KEY_HERE");

  /** Postleitzahl und Ort, an dem sich alle Stände befinden */
  define("POSTLEITZAHL", "12345");
  define("ORT", "Musterstadt");

  // wie viele Stände können maximal an einer Adresse registriert werden?
  define("MAX_HAUSHALTE_PRO_ADRESSE", 10);

  /** Verfügbare Sprachen. Für jede Sprache muss eine Datei unter /www/i18n/ angelegt sein. */
  $languages = array(
    "de" => "Deutsch",
    "en" => "English"
  );

  // AB HIER NICHTS EDITIEREN
  $pdo = @mysqli_connect(
    MYSQL_HOST,
    MYSQL_USER,
    MYSQL_PASS,
    MYSQL_DB,
    MYSQL_PORT,
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
