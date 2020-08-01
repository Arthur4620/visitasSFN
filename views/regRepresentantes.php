<?php 
      include "../DB/conexion.php";

  if(!empty($_POST)) {
    if(empty($_POST['nombre']) || empty($_POST['email']) || empty($_POST['username'])  || empty($_POST['password']) 
    || empty($_POST['zona']) || empty($_POST['rol']))
    {
      $alert= '<p class="msg_error">Todos los campos son obligatorios</p>';
    }else{
      
  
      $nombre   =$_POST['nombre'];
      $email    =$_POST['email'];
      $username =$_POST['username'];
      $password = $_POST['password'];
      $zona     =$_POST['zona'];
      $rol      =$_POST['rol'];
      
  
      $query=mysqli_query($conectar,"SELECT * FROM representantes WHERE username='$username' OR email='$email'");
        $query_result=mysqli_fetch_array($query);
        if($query_result > 0){
          $alert='<p class="msg_error"> El coreo o Usuario ya existe.</p>';
        }
        else{
          $query_insert=mysqli_query($conectar,"INSERT INTO representantes VALUES('','$nombre','$email','$username','$password','$zona','$rol')");
          if ($query_insert) {
           /*echo "<script> alert('correcto');
      location.href='mapa.php';
      </script>";*/
        
          }else{
           $alert='<p class="msg_error">Error al registrar Representante.</p>';
  
          }
        }
    }
  }

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../public/img/icono.png">
    <title>Registro</title>

    <link rel="stylesheet" href="../public/css/carta.css">
</head>
<body>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">
    
    <div class="testbox">
      <h1>Registro</h1>
    
      <form action="" method="POST">
          <hr>
      <label id="icon" for="name"><i class="icon-user"></i></label>
      <input type="text" name="nombre" id="nombre" placeholder="Nombre" required/>
      
      <label id="icon" for="name"><i class="icon-envelope "></i></label>
      <input type="text" id="email" name="email" placeholder="E-mail" required/>

      <label id="icon" for="name"><i class="icon-user"></i></label>
      <input type="text" name="username"  id="username" placeholder="Usuario" required/>

      <label id="icon" for="name"><i class="icon-shield"></i></label>
      <input type="password" id="password" name="password" placeholder="Contraseña" required/>

      <label id="icon" for="name"><i class="icon-circle"></i></label>
      <input type="text" id="zona" name="zona" placeholder="Zona" required/>

      <label for="rol">
                    Rol:
                  </label>

                  <?php
                    $query_rol=mysqli_query($conectar,"SELECT id,rol FROM rol ");
                    $result_rol=mysqli_num_rows($query_rol);

                  ?>

                  <select name="rol" id="rol"  >
                    <?php
                      if($result_rol>0){
                        while($rolUser=mysqli_fetch_array($query_rol)){
                          ?>
                              <option value="<?php echo $rolUser['id']; ?>"> <?php echo $rolUser['rol'];  ?> </option>
                          <?php
                        }
                      }
                    ?>
                    
                  </select>

        <button type="submit" id="button">
            Guardar
        </button>

      </form>
    </div>      
         

    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>   

  </body>

</html>





    