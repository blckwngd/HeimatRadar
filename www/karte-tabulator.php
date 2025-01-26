<?php

$i18n = json_decode(file_get_contents("i18n/de.json"));
  
session_start();
$isLoggedIn = ((isset($_SESSION["API_SECRET"])) && $_SESSION["API_SECRET"] == API_SECRET);
$languages = array(
  "de" => "Deutsch",
  "en" => "English"
);
  /*require_once("config/config.php");
  require_once("staende.php");

  global $i18n, $isLoggedIn;
  $staende0 = json_encode(getStaende());
*/
  $printView = isset($_GET["print"]);

?><!DOCTYPE html>
<html data-theme="light">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title data-i18n="karte.titel"><?= $i18n->karte->titel ?></title>
    
    
    <!-- PicoCSS | https://picocss.com/ -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">

    <!-- Tablulator | https://tabulator.info/ -->
    <link href="https://unpkg.com/tabulator-tables/dist/css/tabulator_site.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://unpkg.com/tabulator-tables/dist/js/tabulator.min.js"></script>

    <!-- PocketBase | https://pocketbase.io/ -->
    <script src="/inc/pocketbase/pocketbase.umd.js"></script>

    <!-- LeafletJS | https://leafletjs.com/ -->  
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>

    <!-- LeafletJS Extra Markers | -->
    <link rel="stylesheet" href="https://www.unpkg.com/leaflet-extra-markers@1.2.2/dist/css/leaflet.extra-markers.min.css" />
    <script src='https://www.unpkg.com/leaflet-extra-markers@1.2.2/dist/js/leaflet.extra-markers.min.js'></script>

    <!-- Fullscreen AddIn | https://github.com/Leaflet/Leaflet.fullscreen -->
    <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
    <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css' rel='stylesheet' />
  
    <!-- GPS AddIn | https://github.com/stefanocudini/leaflet-gps -->
    <script src='/inc/leaflet-gps/leaflet-gps.min.js'></script>
    <link href='/inc/leaflet-gps/leaflet-gps.min.css' rel='stylesheet' />

    <!-- HeimatRadar -->
    <link href='/inc/heimatradar/heimatradar.css' rel='stylesheet' />
    <script src='/inc/heimatradar/heimatradar.js'></script>
    <script src='/config/db_fields.js'></script>

    
    <script type="text/javascript" language="javascript">
      var myMarker = L.ExtraMarkers.icon({
        icon: 'shopping cart icon',
        markerColor: 'green-light',
        shape: 'circle',
        prefix: 'icon',
        extraClasses: 'big'
      });

      var printView = <?php echo ($printView ? 'true' : 'false'); ?>;
      var isLoggedIn = <?php echo ($isLoggedIn ? 'true' : 'false'); ?>;

      const pb = new PocketBase("https://ajna.pockethost.io");
      var objects = null;
      var table = null;

      async function getInitialData() {
        staende = await pb.collection('dorfflohmarkt').getFullList({
          sort: '-created',
        });
        console.log(staende);
        table.setData(staende);
      }

      window.onload = function() {
        
        //Build Tabulator
        table = new Tabulator("#table", {
            height:"311px",
            layout:"fitColumns",
            placeholder:"Keine Daten",
            columns:db_fields,
        });

        //trigger AJAX load on "Load Data via AJAX" button click
        table.on("tableBuilt", function(){
          getInitialData();
        });
        
        //initHeimatRadar()
      };


    </script>

  </head>
  <body>

      <main class="container">

      <?php include_once("modules/header-pico.php"); ?>

      <div id="title">
        <h1 data-i18n="karte.titel"><?= $i18n->karte->titel ?></h1>
        <h2 data-i18n="karte.untertitel"><?= $i18n->karte->untertitel ?></h2>
        <br/>
      </div>

      <div id="summary"></div><br/>

    <div id="map"></div>
    <?php if($printView) {?><div id="qr"><img src="/qrcode_karte.png"></div> <?php } ?>
    
    
    <div>
      
      <?php if(!$printView) { ?>
        <br/><i>Tipp: Um die Tabelle zu durchsuchen, nutzen Sie die Suchfunktion Ihres Browsers</i>
      <?php } ?>

      <div id="table"><!--
        <table>
          <thead>
            <tr>
  <?php if ($isLoggedIn && !$printView) { /* logged in: */?>
              <th data-i18n="reg.inputName_label"><?= $i18n->reg->inputName_label ?></th>
              <th data-i18n="reg.inputEmail_label"><?= $i18n->reg->inputEmail_label ?></th>
              <th data-i18n="reg.inputPhone_label"><?= $i18n->reg->inputPhone_label ?></th>
  <?php } /* not logged in: */ ?>
              <th style="width:170pt;" data-i18n="reg.inputStrasse_label"><?= $i18n->reg->inputStrasse_label ?></th>
              <th style="width:80px;"><center><small data-i18n="reg.inputAnzahl_label"><?= $i18n->reg->inputAnzahl_label ?></small></center></th>
              <th data-i18n="reg.inputAngebot_label"><?= $i18n->reg->inputAngebot_label ?></th>

  <?php if ($isLoggedIn && !$printView) { /* logged in: */?>
              <th data-i18n="reg.inputKommentar_label"><?= $i18n->reg->inputKommentar_label ?></th>
              <th data-i18n="karte.inputAktionen_label"><?= $i18n->karte->inputAktionen_label ?></th>
  <?php } ?>
            </tr>
          </thead>
          <tbody id="tableContent">
          </tbody>-->
        </table>
      </div>
  </main>
  </body>

  <!-- Translation Modul von https://codeburst.io/translating-your-website-in-pure-javascript-98b9fa4ce427 -->
  <script src="https://unpkg.com/@andreasremdt/simple-translator@latest/dist/umd/translator.min.js"></script>
  <script src="inc/i18n.js"></script>

</html>