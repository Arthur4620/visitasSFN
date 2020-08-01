<?php
  include "../DB/conexion.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../public/img/MLab64.png">
  <title>Registro Vendedor</title>


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
          <a class="nav-link" href="mapa2.php">Mapa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="tabVisitas.php">Visitas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="tabClinicas.php">Clinicas</a>
        </li>

        </li>
        <li class="nav-item">
          <a class="nav-link" href="../logout.php">Salir</a>
        </li>
      </ul>
    </div>
  </nav>
<center><h1>Representates</h1></center>
  
  <div class="tabla1">
    <table class="tabla">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>E-mail</th>
          <th>Usuario</th>
          <th>Zona</th>
          <th>Rol</th>
          
        </tr>
      </thead>

          <?php
            $sql_select=mysqli_query($conectar,"SELECT COUNT(*) as totalContenido FROM representantes");
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
              
              $query=mysqli_query($conectar,"SELECT r.id,r.nombre,r.email,r.username,r.zona,o.rol FROM representantes r INNER JOIN rol o ON r.rol=o.id 
              ORDER BY r.id ASC LIMIT $desde, $porPagina");
              $result=mysqli_num_rows($query);
             
              
                if($result >0){
                  while($data=mysqli_fetch_array($query)){
                      ?>

              <tr>
                    <td data-label1="ID"><?php echo $data["id"]; ?></td>
                    <td data-label1="Clinica"><?php echo $data["nombre"]; ?></td>
                    <td data-label1="Más de 1 Doctor"><?php echo $data["email"]; ?></td>
                    <td data-label1="Doctores"><?php echo $data["username"]; ?></td>
                    <td data-label1="Telefono"> <?php echo $data["zona"]; ?></td>
                    <td data-label1="E-mail"> <?php echo $data["rol"]; ?></td>
                    
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

</body>

</html>