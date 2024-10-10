var map;

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
      var marker = L.marker([stand.lat, stand.lon], {icon:myMarker, title:`${stand.strasse}: ${stand.angebot}`});
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

function initHeimatRadar() {
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