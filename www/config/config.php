<?php

  /** MYSQL Zugangsdaten */
  define("MYSQL_USER", "root");
  define("MYSQL_PASS", "");
  
  /** MYSQL Server Adresse und Port*/
  define("MYSQL_HOST", "localhost");
  define("MYSQL_PORT", 3306);

  /** MYSQL Datenbank und Tabelle */
  define("MYSQL_DB", "test");
  define("MYSQL_TABLE", "heimatradar");

  /** Benutzername und Passwort für administrative Arbeiten */
  define("ADMIN_USER", "admin");
  define("ADMIN_PASS", "Admin123");

  /** Setze hier eine sichere, lange Zeichenkette, mit der API-Anfragen authentifiziert werden.  */
  define("API_SECRET", "L_HEFHJ2wuycvdxk");

  /** Key für Geocoding per Google API: https://console.cloud.google.com/apis/credentials */
  define("GOOGLE_MAPS_API_KEY", "AIzaSyD03t0MxCm2i3OG8Ve54h60i45RfUIEgQ8");

  /** Postleitzahl und Ort, an dem sich alle Stände befinden */
  define("POSTLEITZAHL", "56566");
  define("ORT", "Neuwied");

  // wie viele Stände können maximal an einer Adresse registriert werden?
  define("MAX_HAUSHALTE_PRO_ADRESSE", 10);

  /** Verfügbare Sprachen. Für jede Sprache muss eine Datei unter /www/i18n/ angelegt sein. */
  $languages = array(
    "de" => "Deutsch",
    "en" => "English"
  );
  
  $i18n = json_decode(file_get_contents("i18n/de.json"));
  
  session_start();
  $isLoggedIn = ((isset($_SESSION["API_SECRET"])) && $_SESSION["API_SECRET"] == API_SECRET);

  define("HEIMATRADAR_INITIALIZED", true);

?>
