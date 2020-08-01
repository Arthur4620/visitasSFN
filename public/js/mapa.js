var map = L.map('mapa-cuadro').fitWorld();


var titleURL = ('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');


L.tileLayer(titleURL).addTo(map);
map.locate({ enableHighAccuracy: true });
map.locate({ setView: true, maxZoom: 17 });

var CliMarker = L.icon({
  iconUrl: './img/marker2.png',

  iconSize: [30, 30],
  iconAnchor: [20, 40]
})

var labMarker = L.icon({
  iconUrl: './img/MLab256.png',

  iconSize: [30, 30],
  iconAnchor: [20, 40]
});

var CliMarker = L.icon({
  iconUrl: '../img/marker2.png',

  iconSize: [30, 30],
  iconAnchor: [20, 40]
})

var labMarker = L.icon({
  iconUrl: './img/MLab256.png',

  iconSize: [30, 30],
  iconAnchor: [20, 40]
});


map.on('locationfound', e => {

  const coords = [e.latlng.lat, e.latlng.lng];

  const marker = L.marker(coords);
  marker.bindPopup('Tu estas Aqui');
  map.addLayer(marker);
  // socket.emit('userCoordinates',e.latlng);
  // map.coords(latlng);
  var latlng = map.coords;


  function lati() {
    const latitud = [e.latlng.lat];
    const long = [e.latlng.lng];


    if (latitud && long) {
      datos.innerHTML += ` <p id="p1">${latitud},${long}</p>
                          <small>Latitud y Longitud de la ubicacion </small>`;
    }




  }

  window.onload = function () {
    var btn = document.getElementById("Mcoords");
    btn.onclick = lati;


  };


 

});


