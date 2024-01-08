<?php $printView = isset($_GET["print"]) ?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Karte</title>
    
    <!-- LeafletJS | https://leafletjs.com/ -->  
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
    
    <!-- Fullscreen AddIn | https://github.com/Leaflet/Leaflet.fullscreen -->
    <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
    <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css' rel='stylesheet' />
  
    <!-- GPS AddIn | https://github.com/stefanocudini/leaflet-gps -->
    <script src='/inc/leaflet-gps/leaflet-gps.min.js'></script>
    <link href='/inc/leaflet-gps/leaflet-gps.min.css' rel='stylesheet' />


    <style>
      body {
        font-size: 14pt;
        font-family: Verdana,Geneva,sans-serif;
      }
      #map { 
        height: 75%;
        width: 100%;
        margin: 0 auto; 
      }
      #qr {
        position: absolute;
        left: 30px;
        top: 950px;
        z-index: 9999;
      }
      #qr img {
        width: 200px;
        height: 200px;
      } 
      #title {
        text-align: center;
      }
      #summary {
        text-align: center;
      }
      table {
        width: 100%;
        border: 1px solid #000000;
        margin-top:30px;
      }
      table th {
        text-align: left;
        vertical-align: bottom;
        font-size: 14pt;
        font-family: Verdana,Geneva,sans-serif;
      }
      table td {
        border: 1pt solid #000000;
        font-size: 13pt;
        font-family: Verdana,Geneva,sans-serif;
        vertical-align: top;
      }
    </style>
    
    <script type="text/javascript" language="javascript">
    
      var staende0 = <?php include "orte.php"; ?>;
      var map;
      var printView = <?php echo ($printView ? 'true' : 'false'); ?>
      
      async function highlightStand() {
        var standId = this.originalId;
        map.closePopup();
        map.eachLayer(function(layer){
              if (typeof layer.dbId != "undefined" && layer.dbId == standId) {
                layer.openPopup();
              }
          });
      }
      
      async function updateTable(staende) {
        var el = document.getElementById("tableContent");
        var numStaende = 0;
        if (typeof staende[0] != "object") // nur ein Element, kein Array
          staende = [staende];
        for (var i in staende) {
          var stand = staende[i];
          numStaende += parseInt(stand.anzahl);
          var link = printView ? '' : `<br/>(<a href="bingmaps:?cp=${stand.strasse}, 56566 Neuwied" target="_blank"><a href="https://maps.apple.com/maps?q=${stand.strasse}, 56566 Neuwied" target="_blank">In Maps öffnen</a></a>)`;
          var found = false;
          var elStand = document.getElementById("stand" + stand.id);
          if (elStand) {
            // update table element
            var els = elStand.getElementsByTagName("td");
            var addr = stand.strasse + ", 56566 Neuwied";
            els[0].innerHTML = `${stand.strasse}${link}`;
            els[1].innerHTML = stand.anzahl;
            els[2].innerHTML = stand.angebot;
          } else {
            // create new table element
            var elStand = document.createElement("tr");
            elStand.id = "stand" + stand.id;
            var e1 = document.createElement("td");
            e1.innerHTML = `${stand.strasse}${link}`;
            elStand.appendChild(e1);
            
            var e3 = document.createElement("td");
            e3.innerHTML = `${stand.anzahl}`;
            e3.style.textAlign = 'center'
            elStand.appendChild(e3);
            
            var e2 = document.createElement("td");
            e2.innerHTML = stand.angebot;
            elStand.appendChild(e2);
            elStand.originalId = stand.id;
            if (!printView) {
              elStand.addEventListener("mouseover", highlightStand);
            }
            el.appendChild(elStand);
          }
        }
        var elSum = document.getElementById("summary");
        if (printView) {
          elSum.innerHTML = "Es nehmen <b>" + numStaende + "</b> Stände an <b>" + staende.length + "</b> Standorten teil.<br/>Interaktive Karte unter <b>www.rethink-ev.de</b>"
        } else {
          elSum.innerHTML = "Es sind bereits <b>" + numStaende + "</b> Stände an <b>" + staende.length + "</b> Standorten registriert! (<a href=\"?print\">Druckversion</a>) (<a href=\"#\" onclick=\"toggleFullscreen()\">Vollbild</a>)"
        }
      }
      
      async function updateMap(map, staende) {
        if (typeof staende[0] != "object") // nur ein Element, kein Array
          staende = [staende];
        for (var i in staende) {
          var stand = staende[i];
          var found = false;
          var link = printView ? '' : `<a href="bingmaps:?cp=${stand.strasse}, 56566 Neuwied" target="_blank"><a href="https://maps.apple.com/maps?q=${stand.strasse}, 56566 Neuwied" target="_blank">In Maps öffnen</a></a>`;
          map.eachLayer(function(layer){
              if (typeof layer.dbId != "undefined" && layer.dbId == stand.id) {
                found = true;
                if (layer.dbStrasse !== stand.strasse) {
                  layer.dbStrasse = stand.strasse;
                  layer.options.title = layer._icon.title = `${stand.strasse}: ${stand.angebot}`;
                  layer.bindPopup(`<b>${stand.strasse}</b><br>${stand.angebot}<br/>${link}`);
                }
                if (layer.dbAngebot !== stand.angebot) {
                  layer.dbAngebot = stand.angebot;
                  layer.options.title = layer._icon.title = `${stand.strasse}: ${stand.angebot}`;
                  layer.bindPopup(`<b>${stand.strasse}</b><br>${stand.angebot}<br/>${link}`);
                }
              }
          });
          if (!found) {
            var marker = L.marker([stand.lat, stand.lon], {title:`${stand.strasse}: ${stand.angebot}`});
            marker.dbId = stand.id;
            marker.dbStrasse = stand.strasse;
            marker.dbAngebot = stand.angebot;
            marker.addTo(map);
            marker.bindPopup(`<b>${stand.strasse}</b><br>${stand.angebot}<br/>${link}`);
          }
        }
        
        if (printView) { fitView(); }
        
      }
      
      async function updateData(map) {
        let Response = await fetch('/orte.php/');
        let staende = await Response.json();
        updateMap(map, staende);
        updateTable(staende);
        staende0 = staende;
      }
      
      window.onload = function(){
        map = L.map('map', {zoomSnap: 0.25, fullscreenControl: true}).setView([50.45, 7.543], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap',
            tileSize: 512,
            zoomOffset: -1
        }).addTo(map);
        if (printView) {
          map.removeControl(map.zoomControl)
          map.removeControl(map.attributionControl)
        }
        
        updateMap(map, staende0)
        updateTable(staende0)
        if (!printView) {
          window.setInterval(function(){updateData(map)}, 5000)
          map.addControl(
            new L.Control.Gps({
               autoActive: true,
               title: 'Karte auf Standort zentrieren',
               style: {radius:8,color:'#c20',fillColor:'#f23'}
            })
          );
        }
        
        //map.locate({setView: false, maxZoom: 16});
      }

      function fitView() {
        var el = document.getElementById("map")
        el.style.width="210mm"
        el.style.height="250mm"
        map.invalidateSize()
        var markers = []
        map.eachLayer(function (layer) { 
          if (typeof layer.dbId != "undefined") {
            markers.push(layer)
          }
        });
        var group = new L.featureGroup(markers)
        map.fitBounds(group.getBounds())
        map.zoomIn(0.5)
      }
      
      function toggleFullscreen() {
        map.toggleFullscreen()
      }

    </script>
  </head>
  <body>
    <div id="title">
      <h1>Willkommen beim Hof- und Gartenflohmarkt</h1>
      <h2>am 02.09.2023, 9-16 Uhr, in ganz Heimbach-Weis</h2>
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