<?php
  include '../DB/conexion.php';

  $fecha_de='';
  $fecha_a='';

  if (!empty($_REQUEST['fecha_de'])&&!empty($_REQUEST['fecha_a'])) {
   $fecha_de=$_REQUEST['fecha_de'];
   $fecha_a=$_REQUEST['fecha_a'];

   $buscar='';
  if ($fecha_de > $fecha_a) {
      header("location:clinica.php");
  }else if($fecha_de == $fecha_a){
    $where="fecha LIKE '$fecha_de%'";

    $buscar="fecha_de=$fecha_de&fecha_a=$fecha_a";
  }
  else{
   
    $where="fecha BETWEEN '$fecha_de%' AND '$fecha_a%' ";
    $buscar="fecha_de= $fecha_de & fecha_a= $fecha_a";

   }
  }

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../public/img/MLab64.png">
  <title>Registro Clinicas</title>


  <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css" crossorigin="anonymous">
  <link rel="stylesheet" href="../public/css/tablas.css">
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">San Francisco</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
      
      
        <li class="nav-item">
          <a class="nav-link" href="mapa2.php"> Mapa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="tabVisitas.php">Visitas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="tabRepresentantes.php">Representantes</a>
        </li>

        </li>
        <li class="nav-item">
          <a class="nav-link" href="../logout.php">Salir</a>
        </li>
      </ul>
    </div>
  </nav>

  <center><h1>Clinicas</h1></center>

  <div class="tabla1">
    <table class="tabla">
      <thead>
        <tr>
          <th>ID</th>
          <th>Clinica</th>
          <th>Más de 1 Doctor</th>
          <th>Doctores</th>
          <th>Telefono</th>
          <th>E-mail</th>
          <th>Usuario</th>
          <th>Observaciones</th>
        </tr>
      </thead>

          <?php
            $sql_select=mysqli_query($conectar,"SELECT COUNT(*) as totalContenido FROM clinica");
            $result_select=mysqli_fetch_array($sql_select);
            $totalContenido=$result_select['totalContenido'];
            $porPagina=25;
              if(empty($_GET['pagina'])){
                $pagina=1;
              }else{
                $pagina=$_GET['pagina'];
              }
                //contadore de paginas
              $desde=($pagina-1)*$porPagina;
              $totalPaginas=ceil($totalContenido/$porPagina);
              
              $query=mysqli_query($conectar,"SELECT c.id,c.nombre,c.masdocs,c.doctores,c.telefono,c.email,c.usuario,c.obser FROM clinica c 
              ORDER BY c.id ASC LIMIT $desde, $porPagina");
              $result=mysqli_num_rows($query);
             
              
                if($result >0){
                  while($data=mysqli_fetch_array($query)){
                      ?>

              <tr>
                    <td data-label1="ID"><?php echo $data["id"]; ?></td>
                    <td data-label1="Clinica"><?php echo $data["nombre"]; ?></td>
                    <td data-label1="Más de 1 Doctor"><?php echo $data["masdocs"]; ?></td>
                    <td data-label1="Doctores"><?php echo $data["doctores"]; ?></td>
                    <td data-label1="Telefono"> <?php echo $data["telefono"]; ?></td>
                    <td data-label1="E-mail"> <?php echo $data["email"]; ?></td>
                    
                    <td data-label1="Usuario"><?php echo $data["usuario"] ?></td>
                    <td data-label1="Observaciones"><?php echo $data["obser"] ?></td>

              </tr>
          <?php
                  }
                }

          ?>
    </table>
          <div class="paginador">
            <ul>
              <?php
                if($pagina !=1){

                   ?>
                   <li> <a href="?pagina=<?php echo 1; ?>"> | <<</a></li>
                   <li><a href="?pagina=<?php echo $pagina-1; ?>"><<</a></li>

                   <?php
                }
                  for($i=1; $i<=$totalContenido; $i++){
                    if($i == $pagina){
                      echo '<li class="pageSelected">'.$i. '</li>'; 
                    }else{
                      echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
                    }
                  }
                    if($pagina != $totalContenido){
                     ?> 
                        <li><a href="?pagina=<?php echo $pagina+1; ?>">>></a></li>
                        <li><a href="?pagina=<?php echo $totalPaginas; ?>">>|</a></li>
                   <?php } ?>
            </ul>
          </div>
    
  </div>


  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>

    <script src="../../js/scripstExcel.js"></script>
</body>

</html>