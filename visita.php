<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="public/img/MLab64.png">
  <title>Visita</title>


  <head>

    <link href="public/css/estilo.css" rel="stylesheet" type="text/css" />
    <!--carga de css.. -->
    <script type="text/javascript" src="ajax.js"></script> <!-- Carga de js.. -->
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>

    <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
  </head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">San Francisco</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">

        <li class="nav-item">
          <a class="nav-link" href="views/mapa.php">Mapa</a>
        </li>


        <li class="nav-item">
          <a class="nav-link" href="../logout.php">Salir</a>
        </li>
      </ul>
    </div>
  </nav>

  <?php
  include('DB/conexion.php');
  date_default_timezone_set('America/Mexico_City');
  $fecha_actual = date("Y-m-d H:i:s");

  if (!empty($_POST)) {
    $aler = '';

    if (
      empty($_POST['namecli']) || empty($_POST['docs']) || empty($_POST['cords']) || empty($_POST['tipov'])
      || empty($_POST['representante']) || empty($_POST['actual'])
    ) {
      $alert = '<p class="msg_error"> Falta uno o mas campos </p>';
    } else {


      $namecli = $_POST['namecli'];
      $docs = $_POST['docs'];
      $cords = $_POST['cords'];
      $tipov   = $_POST['tipov'];
      $obser   = $_POST['obser'];
      $fecha = $_POST['fecha'];
      $representante = $_POST['representante'];
      $actual = $_POST['actual'];


      if ($cords === $actual) {
        $actual = 1;
        $query_insert = mysqli_query($conectar, "INSERT INTO visita2 VALUES('','$namecli','$docs','$cords','$tipov','$obser','$fecha','$representante','$actual')");
      } else {
        $actual = 2;
        $query_insert = mysqli_query($conectar, "INSERT INTO visita2 VALUES('','$namecli','$docs','$cords','$tipov','$obser','$fecha','$representante','$actual')");
      }

      if ($query_insert) {
        echo 'listo';
        $alert = '<p class="msg_save"> La clinica se agrego </p>';
      } else {
        echo $actual;
        $alert = '<p class="msg_error">El Registro no se realizo </p>';
      }
    }
  }

  ?>
  <center>
    <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
  </center>
  <div class="row">
    <div id="row" class="col-md-4 offset-md-4">
      <div class="card mt-4 text-center">
        <div class="card-header">
          <h2>Visita</h2>
          <hr>

          <div>
            <label id="titulo" for="namecli">Ingrese Clinica</label> <br>
            <input type="text" name="busqueda" id="busqueda" onKeyUp="lookup(this.value);" autocomplete="off" placeholder="Palabra clave">
            <div class="suggestionsBox" id="suggestions" style="display:none;">
              <!-- div para imprimir resultados -->
              <div class="suggestionList" id="autoSuggestionsList"></div>
            </div>
          </div>
        </div>
        <style>
          input {
            width: 300px;
            height: 35px;
            border-radius: 5px;
            border-color: #EEC284;
            margin-top: 25px;
          }

          #busqueda {
            width: 300px;
            height: 35px;
            border-radius: 5px;
            border-color: #B584EE;
            margin-top: 25px;
          }
        </style>
        <!--Este campo se llenará al seleccionar un item de la lista -->
        <input type="hidden" name="id_reg" id="id_reg">


        <form name="form1" id="form1" enctype="multipart/form-data" method="POST">

          <!--Al detectarse dato en id_reg se solicitará información de dicho elemento para llenar la siguiente informacion-->
          <div id="div_resp">

            <br>
            <label id="titulo" for="namecli"> Clinica:</label>
            <br> <input type="text" name="namecli" id="namecli">
            <br>
            <br> <label id="titulo" for="docs">Doctores:</label> <br>
            <input type="text" name="docs" id="docs">
            <br><br>
            <label id="titulo" for="namecli">
              Tipo Visita:
            </label>
            <?php
            $query_visita = mysqli_query($conectar, "SELECT id,tipov FROM tipov ");
            $result_visita = mysqli_num_rows($query_visita);

            ?>
            <br>
            <select name="tipov" id="tipov">

              <?php
              if ($result_visita > 0) {
                while ($tipoVisita = mysqli_fetch_array($query_visita)) {
              ?>
                  <option value="<?php echo $tipoVisita['id']; ?>"> <?php echo $tipoVisita['tipov'];  ?> </option>
              <?php
                }
              }
              ?>
            </select>
            <br><br>

            <label id="titulo" for="namecli">
              Observaciones:
            </label>
            <br>
            <textarea name="obser" id="obser" cols="30" rows="10"></textarea>

            <div class="form-group">
              <input type="hidden" id="fecha" name="fecha" value="<?= $fecha_actual ?>">
            </div>
          </div>
          <br>
          <label id="titulo" for="namecli">
            Usuario:
          </label>

          <?php
          $query_repre = mysqli_query($conectar, "SELECT id,username FROM representantes ");
          $result_repre = mysqli_num_rows($query_visita);

          ?>
          <br>
          <select name="representante" id="representante">

            <?php
            if ($result_repre > 0) {
              while ($Repre = mysqli_fetch_array($query_repre)) {
            ?>
                <option value="<?php echo $Repre['id']; ?>"> <?php echo $Repre['username'];  ?> </option>
            <?php
              }
            }
            ?>
          </select>

          <br>
          <!-- DATOS -->
          <input type="hidden" id="actual" name="actual">
          <!--  
		<div id="datos">
			
      </div>
        -->




          <button id="button" type="submit" class="btn btn-success btn-block mt-4">
            Guardar
          </button>
        </form>

      </div>
    </div>

  </div>
  </div>
  <style>
    #map-template {

      width: 480px;
      height: 300px;

    }
  </style>
  <hr>
  <br>
  <center>
    <div id="map-template">

    </div>
  </center>
  <hr>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

  <script>
    var map = L.map('map-template').fitWorld();
    var titleURL = ('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
    L.tileLayer(titleURL).addTo(map);
    map.locate({
      enableHighAccuracy: true
    });
    map.locate({
      setView: true,
      maxZoom: 17
    });




    map.on('locationfound', e => {

      const coords = [e.latlng.lat, e.latlng.lng];
      const marker = L.marker(coords);
      marker.bindPopup('Tu estas Aqui');
      map.addLayer(marker);

     
      function validar() {
        var latitud = [e.latlng.lat];
        var longitud = [e.latlng.lng];
        console.log(latitud + longitud);

        var cordsActual = latitud + "," + longitud;
        document.getElementById("actual").value = cordsActual;
        //datos.innerHTML=`<input type="text" id="actualCords" name="actualCords" value="${cordsActual}">`;
        //=document.getElementById("cords").value;
        console.log(cordsActual);



      }
      validar();
    });
  </script>

</body>

</html>