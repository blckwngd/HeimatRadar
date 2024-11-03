<?php

  require_once("config/config.php");
  require_once("staende.php");

  global $i18n, $isLoggedIn;

  $printView = isset($_GET["print"]);
  $staende0 = getStaende();

?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Karte</title>
    
    <!-- LeafletJS | https://leafletjs.com/ -->  
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>

    <!-- LeafletJS Extra Markers | -->
    <link rel="stylesheet" href="https://www.unpkg.com/leaflet-extra-markers@1.2.2/dist/css/leaflet.extra-markers.min.css" />
    <script src='https://www.unpkg.com/leaflet-extra-markers@1.2.2/dist/js/leaflet.extra-markers.min.js'></script>

    <!-- Semantic UI -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.0/dist/semantic.min.css" />

    <!-- Fullscreen AddIn | https://github.com/Leaflet/Leaflet.fullscreen -->
    <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
    <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css' rel='stylesheet' />
  
    <!-- GPS AddIn | https://github.com/stefanocudini/leaflet-gps -->
    <script src='/inc/leaflet-gps/leaflet-gps.min.js'></script>
    <link href='/inc/leaflet-gps/leaflet-gps.min.css' rel='stylesheet' />

    <!-- HeimatRadar -->
    <link href='/inc/heimatradar/heimatradar.css' rel='stylesheet' />
    <script src='/inc/heimatradar/heimatradar.js'></script>

    
    <script type="text/javascript" language="javascript">
      var myMarker = L.ExtraMarkers.icon({
        icon: 'shopping cart icon',
        markerColor: 'green-light',
        shape: 'circle',
        prefix: 'icon',
        extraClasses: 'big'
      });

      var staende0 = <?= $staende0 ?>;
      var printView = <?php echo ($printView ? 'true' : 'false'); ?>;

      window.onload = initHeimatRadar;
    </script>

  </head>
  <body>
    <div id="title">
      <h1><?= $i18n->karte->titel ?></h1>
      <h2><?= $i18n->karte->untertitel ?></h2>
    </div>
    <div id="summary"></div><br/>
    <div id="map"></div>
    <?php if($printView) {?><div id="qr"><img src="/qrcode_karte.png"></div> <?php } ?>
    <?php 
      if(!$printView) { ?><br/><div>Tipp: Um die Tabelle zu durchsuchen, nutzen Sie die Suchfunktion Ihres Browsers</div><?php } ?>
    <div id="table">
      <table>
        <thead>
          <tr>
            <th style="width:170pt;">Adresse</th>
            <th><center><small>Zahl d. Stände</small></center></th>
            <th>Angebot</th>
          </tr>
        </thead>
        <tbody id="tableContent">
        </tbody>
      </table>
    </div>
  </body>
</html>