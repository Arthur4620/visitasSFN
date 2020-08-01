var map = L.map('map-template').fitWorld();
var titleURL = ('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
L.tileLayer(titleURL).addTo(map);
map.locate({ enableHighAccuracy: true });
map.locate({ setView: true, maxZoom: 17 });




map.on('locationfound', e => {

  const coords = [e.latlng.lat, e.latlng.lng];
  const marker = L.marker(coords);
  marker.bindPopup('Tu estas Aqui');
  map.addLayer(marker);

   var vali= document.getElementById('');
   
    function validar (vali){
    var latitud=[e.latlng.lat];
    var longitud=[e.latlng.lng];
    console.log(latitud + longitud);

    var cordsActual=latitud +","+ longitud;
   // document.getElementById("actualCords").value=cordsActual;
    datos.innerHTML=`<input type="text" id="actualCords" name="actualCords" value="${cordsActual}">
    `;
      //=document.getElementById("cords").value;
         console.log(cordsActual);
       
 

}
validar();
});


