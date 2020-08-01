<?php
  include "../DB/conexion.php";

  if(!empty($_POST)){
    $alert='';
  if(empty($_POST['nombre']) || empty($_POST['doctores']) 
  || empty($_POST['telefono']) || empty($_POST['email']) || empty($_POST['cords']) 
  || empty($_POST['usuario']))
  {
    $alert='<p class="msg_error"> Falta uno o mas campos (Observaciones no es obligatorio) </p>';
  }else{

    $nombre   =$_POST['nombre'];
    $masdocs =$_POST['coincide'];
    $doctores =$_POST['doctores'];
    $telefono =$_POST['telefono'];
    $email    =$_POST['email'];
    $cords    =$_POST['cords'];
    $usuario  =$_POST['usuario'];
    $obser    =$_POST['obser'];

      $query_insert=mysqli_query($conectar,"INSERT INTO clinica VALUES('','$nombre','$masdocs','$doctores',
      '$telefono','$email','$cords','$usuario','$obser')");

      if($query_insert){
        $alert='<p class="msg_save"> La clinica se agrego </p>';
      }else{
        $alert='<p class="msg_error">El Registro no se realizo </p>';
      }

    }

  }
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../public/img/MLab64.png">
  <title>Mapa</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <!-- enlaces  <link href="../css/style.css" rel="stylesheet">-->
  <link rel="stylesheet" href="../public/icon/style.css">
  <!--<link rel="stylesheet" href="/css/menu2.css">-->
  <script src="https://unpkg.com/clipboard@2/dist/clipboard.min.js"></script>
  <!--CSS DE MAPAS Leaflet-->
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
  <link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">


  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
  <link rel="stylesheet" type="text/css" href="../public/css/main.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="../public/js/main.js"></script>

    

</head>

<body>

  <header>
    <div class="menu-bar">
      <a href="#" class="bt-menu"><span class="icon-equalizer"></span> Menú</a>
    </div>
    <nav>
      <ul>
        <a href="mapa2.php">
          <li><span class="icon-map"></span> Mapa</li>
        </a>
        <!-- 
        <li data-toggle="modal" data-target="#exampleModal"><img src="../public/img/hospital-user-solid.svg" alt=""> Agregar Clínica</li>
         <li data-toggle="modal" data-target="#exampleModal3"><span class="icon-office"></span> Clínicas 
    <span class="icon-user-plus"></span>
    </li>
        <li data-toggle="modal" data-target="#exampleModal2"><span class="icon-lab"></span> Laboratorios</li>
        <li data-toggle="modal" data-target="#exampleModal4"><span class="icon-pencil2"></span>Registro</li>
        <li data-toggle="modal" ><span class="icon-pencil2"></span> <a href="views/regRepresentantes.php">representantes </a></li>
        
        <a href="../visita.php">
          <li data-toggle="modal" data-target=""><span class="icon-pencil2"> Visita </li>
        </a>-->
        <a href="tabClinicas.php">
          <li><img src="../public/img/hospital-solid.svg" alt="">Tablas Clinicas</li>
        </a>
        <a href="tabVisitas.php">
          <li> <img src="../public/img/edit-regular.svg" alt="">Tablas Visitas </li>
        </a>
        <a href="tabRepresentantes.php">
          <li> <img src="../public/img/user-friends-solid.svg" alt=""></i>Representantes</li>
        </a>

        <a href="../logout.php">
          <li> <span class="icon-exit"></span> Salir</li>
        </a>

      </ul>
    </nav>
  </header>

  <style>
    .alert {
      width: 100%;
      background: #66e07d66;
      border-radius: 6px;
      margin: 20px auto;
    }

    .alert p {
      padding: 10px;
    }

    .msg_error {
      color: #e65656;
    }

    .msg_save {
      color: #126e00;
    }

    img {
      height: 19px;


    }
  </style>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">INGRESE LOS SIGUIENTES DATOS PARA AGREGAR UNA UBICACION NUEVA
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form action="" method="POST">
            <div class="form-group">
              <label for="nombreNewU">Nombre de la clinica:</label>
              <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" aria-describedby="emailHelp">

            </div>

            
            <label >
            ¿Mas de 1 Doctor?: <!-- Modificar para seleccionar si o no-->
            </label>
    <?php
        $query_visita = mysqli_query($conectar, "SELECT id,coincidencia FROM coincide ");
        $result_visita = mysqli_num_rows($query_visita);

        ?>
        <br>
        <select name="coincide" id="coincide">

          <?php
          if ($result_visita > 0) {
            while ($tipoVisita = mysqli_fetch_array($query_visita)) {
          ?>
              <option value="<?php echo $tipoVisita['id']; ?>"> <?php echo $tipoVisita['coincidencia'];  ?> </option>
          <?php
            }
          }
          ?>
		</select>
        <br><br>
            <hr>

            <div class="form-group">
              <label for="nombreNewU">Nombre del doctor o doctores:</label>
              <input type="text" class="form-control form-control-sm" id="doctores" name="doctores" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
              <label for="nombreNewU">Telefono:</label>
              <input type="text" class="form-control form-control-sm" id="telefono" name="telefono" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
              <label for="nombreNewU">E-mail:</label>
              <input type="email" class="form-control form-control-sm" id="email" name="email" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
              <label for="latitudNew">Latitud: & Longitud:</label>
              <input type="text" id="coordenadas" name="cords" class="form-control form-control-sm">
              <small id="comentario" class="form-text text-muted">Pega Aqui.</small>
            </div>

            <div class="form-group">
              <label for="nombreNewU">Usuario:</label>
              <input type="text" class="form-control form-control-sm" id="usuario" name="usuario" aria-describedby="emailHelp">
            </div>

            <textarea name="obser" id="obser" cols="46" rows="5"></textarea>


            <div id="datos">
              <button onclick="return validar()" data-clipboard-target=" #p1 ">
                <img src="../public/img/clippy1.png" alt="Copy to clipboard">
                <small>Copiar</small>
              </button>
            </div>
        </div>


        <input type="button" class="btn btn-warning" id="Mcoords" value="Generar Longitud y Latitud">
        <small id="comentario" class="form-text text-muted">Haga click para mostrar Longitud y Latitud.</small>
        <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Agregar</button>
          </form>
          <div id="error">

          </div>

          <script>
            new ClipboardJS('button');

            var nombre = document.getElementById('nombreNewU');
            var validarCord = document.getElementById('coordenadas');
            var error = document.getElementById('error');
            error.style.color = 'red';

            function validar() {
              var mensajesError = [];
              if (nombre.value === null || nombre.value === ''); {
                mensajesError.push('Ingresa tu nombre');
              }
              if (validarCord.value === null || validarCord.value === '') {
                mensajesError.push('Ingresa Coordenaas');
              }

              error.innerHTML = mensajesError.join(', ');
              return false;
            }
          </script>

        </div>
      </div>
    </div>
  </div>




  <!-- Modal Select-->
  <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Selecciona un Laboratorio</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <select name="select-location" id="select-location" class="custom-select custom-select-lg sm" multiple>

            <option value="20.5863352,-100.3921815">Lab Queretaro</option>
            <option value="19.5670808,-99.045446">Lab Tulpetlac</option>
            <option value="19.5356666,-99.0689966">Lab Santa Clara</option>


          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

        </div>
      </div>
    </div>
  </div>

  <!-- Modal Select-->
  <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Selecciona una Clinica</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

        </div>
      </div>
    </div>
  </div>


  <!-- Modal Select-->
  <div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registros</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <a class="dropdown-item " href="/visita">Registro Visitas</a>
          <a class="dropdown-item" href="/redDoc">Registro Doctores</a>
          <a class="dropdown-item" href="/regmedico">Registro Medicos</a>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

        </div>
      </div>
    </div>
  </div>

  <?php
  $query = mysqli_query($conectar, "SELECT c.nombre,c.cords FROM clinica c");
  $result = mysqli_num_rows($query);
  ?>
  <input type="hidden" id="long" value="<?php echo $result ?>">

<?php
  if ($result >=0) {
    while ($data = mysqli_fetch_array($query)) {
      $localizacion[]=array("nombre"=>$data[0],"cords"=>$data[1]);
      $objJson=json_encode($localizacion);
        //echo($objJson);
    }
  }
  ?>
    
  
  <div id="mapa-cuadro">

  </div>




  <!--scripts -->
  <script src="/dist/clipboard.min.js"></script>
  <!--<script src="../public/js/copiar.js"></script>-->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

  <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  <!--<script src="/socket.io/socket.io.js"></script>

  <script src="../public/js/mapa.js"></script>
-->
  <!--Jquery-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <script src="../public/js/menu.js"> </script>
  <script>
var map = L.map('mapa-cuadro').fitWorld();
var titleURL = ('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
L.tileLayer(titleURL).addTo(map);
map.locate({ enableHighAccuracy: false });
map.locate({ setView: true, maxZoom: 17 });

var CliMarker = L.icon({
  iconUrl: '../public/img/marker2.png',

  iconSize: [30, 30],
  iconAnchor: [20, 40]
})

var labMarker = L.icon({
  iconUrl: '../public/img/MLab256.png',

  iconSize: [30, 30],
  iconAnchor: [20, 40]
});

var CliMarker = L.icon({
  iconUrl: '../public/img/marker2.png',

  iconSize: [30, 30],
  iconAnchor: [20, 40]
})

var labMarker = L.icon({
  iconUrl: '../public/img/MLab256.png',

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
      datos.innerHTML = ` <p id="p1">${latitud},${long}</p>
                          <small>Latitud y Longitud de la ubicacion </small>`;
    }




  }

  window.onload = function () {
    var btn = document.getElementById("Mcoords");
    btn.onclick = lati;


  };

    


     var json=eval(<?php echo $objJson; ?>);
     
     var markers= new Array;
         
          for(i=0;i<json.length;i++){
            var h=(json[i].nombre +"/"+json[i].cords);
            
            var datos=h.split("/");
            var nombre=datos[0];
            var coorde=datos[1];
            var c=coorde.split(",");
            var lat=c[0];
            var long=c[1];
              //document.write(nombre+"/"+lat+"/"+long +"<br/>");

            markers.push([[nombre,lat,long]]);
            console.log(markers);
            var coordenadas=[markers[i][0][1], markers[i][0][2]];
            const marker=new L.marker(coordenadas).bindPopup(markers[i][0][0]).addTo(map);
              


          }
 

});
       
     </script>
     
 </body>

</html>