<?php
include '../DB/conexion.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../public/img/MLab64.png">
  <title>Visita Tablas</title>
  <script src="../public/js/xlsx.full.min.js"></script>
  <script src="../public/js/FileSaver.min.js"></script>
  <script src="../public/js/tableexport.min.js"></script>
  <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css" crossorigin="anonymous">
  <link rel="stylesheet" href="../public/css/tablas.css">
</head>

<body>

<style>
  hr{
    width: 980px;

  }
</style>


  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">San Francisco</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">

        <li class="nav-item">
          <a class="nav-link" href="mapa2.php">Mapa</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="tabClinicas.php">Clinicas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="tabRepresentantes.php">Representantes</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="../logout.php">Salir</a>
        </li>
      </ul>
    </div>
  </nav>
  <center><h1>Visitas</h1></center> <br>
  <button id="btnExportar" class="btn btn-success"><i class="fas fa-file-export"></i> Exportar Excel</button>
<hr>
  <div class="tabla1">
    <table id="tabla" class="tabla">
      <thead>
        <tr>
          <th>ID</th>
          <th>Clinica</th>
          <th>Doctores</th>
          <th>Tipo Visita</th>
          <th>Observaciones</th>
          <th>Fecha</th>
          <th>Representante</th>
          <th>Match</th>
        </tr>
      </thead>
      <?php
      $sql_select = mysqli_query($conectar, "SELECT COUNT(*) as totalContenido FROM visita2");
      $result_select = mysqli_fetch_array($sql_select);
      $totalContenido = $result_select['totalContenido'];
      $porPagina = 25;
      if (empty($_GET['pagina'])) {
        $pagina = 1;
      } else {
        $pagina = $_GET['pagina'];
      }
      //contadore de paginas
      $desde = ($pagina - 1) * $porPagina;
      $totalPaginas = ceil($totalContenido / $porPagina);

      $query = mysqli_query($conectar, "SELECT v.id,v.namecli,v.docs,t.tipov,v.obser,v.fecha,r.nombre,a.coincidencia FROM visita2 v INNER JOIN tipov t ON v.tipov=t.id  INNER JOIN representantes r ON v.nombre=r.id INNER JOIN coincide a ON v.coincidencia=a.id ORDER BY v.id ASC LIMIT $desde, $porPagina");
      $result = mysqli_num_rows($query);
      //$query = mysqli_query($conectar, "SELECT v.id,v.namecli,v.docs,t.tipov,v.obser,v.fecha,r.nombre,a.coincidencia FROM visita2 v INNER JOIN tipov t ON v.tipov=t.id INNER JOIN representantes r ON v.nombre=r.id INNER JOIN concide a ON v.coincidencia=a.id ORDER BY v.id ASC LIMIT $desde, $porPagina");
     

      if ($result > 0) {
        while ($data = mysqli_fetch_array($query)) {
      ?>

          <tr>
            <td data-label1="ID"><?php echo $data["id"]; ?></td>
            <td data-label1="Clinica"><?php echo $data["namecli"]; ?></td>
            <td data-label1="Doctores"><?php echo $data["docs"]; ?></td>
            <td data-label1="Tipo Visita"> <?php echo $data["tipov"]; ?></td>
            <td data-label1="Observaciones"> <?php echo $data["obser"]; ?></td>
            <td data-label1="Fecha"> <?php echo $data["fecha"]; ?></td>
            <td data-label1="Representante"> <?php echo $data["nombre"]; ?></td>
            <td data-label1="Match"> <?php echo $data["coincidencia"]; ?></td>

          </tr>
      <?php
        }
      }

      ?>
    </table>
    <div class="paginador">
      <ul>
        <?php
        if ($pagina != 1) {

        ?>
          <li> <a href="?pagina=<?php echo 1; ?>"> | <<</a> </li> <li><a href="?pagina=<?php echo $pagina - 1; ?>">
                  <<</a> </li> <?php
                              }
                              for ($i = 1; $i <= $totalContenido; $i++) {
                                if ($i == $pagina) {
                                  echo '<li class="pageSelected">' .$i. '</li>';
                                } else {
                                  echo '<li><a href="?pagina=' . $i . '">' . $i . '</a></li>';
                                }
                              }
                              if ($pagina != $totalContenido) {
                                ?> <li><a href="?pagina=<?php echo $pagina + 1; ?>">>></a></li>
          <li><a href="?pagina=<?php echo $totalPaginas; ?>">>|</a></li>
        <?php } ?>
      </ul>
    </div>



  </div>

  <script src="../public/js/scripstExcel.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>

</html>