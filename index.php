<?php
    include 'database.php';

 session_start();
 if(isset($_GET['cerrar_sesion'])){
     session_unset();

     session_destroy();
 }

 if(isset($_SESSION['rol'])){
     switch($_SESSION['rol']){
         case 1:
             header('location: views/mapa.php');
         break;

         case 2:
             header('location: views/mapa2.php');
         break;

         default:

            }
 }

 if(isset($_POST['username']) && isset($_POST['password'])){
     $username =$_POST['username'];
     $password =$_POST['password'];
     $db = new DB();
     $query=$db-> connect()->prepare('SELECT * FROM representantes WHERE username = :username AND password = :password');
     $query->execute(['username' => $username, 'password' => $password]);
        
     $row = $query->fetch(PDO::FETCH_NUM);
     if($row == true){
         $rol=$row[6];

         $_SESSION['rol']=$rol;
         switch($rol){
             case 1:
                 header('location: views/mapa.php');
             break;
 
             case 2:
                 header('location: views/mapa2.php');
             break;
 
         break;
             default:
         }

     }else{
         echo "No existe el usuario o contraseña";
         
     }

 }
?>

        <!DOCTYPE html>
        <html lang="es">
        
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
            <link rel="icon" href="public/img/icono.png">
           <!--Meta  -->
           <!--color de la aplicacion -->
           <meta name="theme-color" content="rgb(232, 112, 32)"  />
            <!--Optimizacion mobil -->
           <meta name="MobileOptimized" content="width" />
           <meta name="HandheldFriendly" content="true" />
            <!--meta pwa Apple-->
            <meta name="apple-mobile-web-app-capable" content="yes" />
            <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
            <link rel="apple-touch-icon" href="public/img/icono.png" />
            <link rel="apple-touch-startup-image" href="public/img/icono.png" />

            <!-- configuracion General de PWA -->
            <link rel="manifest" href="manifest.json" />

            
            <title>Iniciar Sesión</title>

            <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <!--scrip main-->
            <script src="./main.js"> </script>
            <link rel="stylesheet" href="public/css/normalize.css">
            <link rel="stylesheet" href="public/css/main2.css">
            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="public/css/all.min.css">
           

        </head>
        
        <body>
        
          
        
        
            <!-- FONDO -->
            <div class="fond-pink">
            </div>
            <div class="fond-blue">
            </div>
        
            <!-- LOGIN -->
            <header>
                <div class="container">
                    <div class="container-flex">
        
                        <!-- CAJA 1 -->
                        <div class="caja1">
                            <div class="checked-flex">
                                <input type="checkbox" class="checked-color" id="check">
                                <p>San Francisco</p>
                            </div>
                            <div class="caja1-titulo">
                                <h1>Sign Up</h1>
                                
                            </div>
                           
                            <div class="selectForm">
                                <div class="select-i">
                                   <!-- <i class="fas fa-chevron-right"></i>-->
                                </div>
                            </div>
                        </div>
        
                        <!-- CAJA 2 -->
                        <div class="caja2">
                            <form action="" method="POST" id="Form"> 
                            
                                <div class="form-flex">
                                    <label for="email" class="texto">Usuario</label>
                                     <input class="form-control" type="text" name="username" placeholder="Insertar Usuario" >
                                </div>
        
                                <div class="form-flex">
                                    <label for="contra" class="texto">Contraseña</label>
                                    <input type="password" type="password" name="password"  placeholder="Contraseña" required>
                                </div>
        
        
                                <input type="submit" value="Iniciar Sesión" class="boton">
        
                                <div class="caja1-registro">
                                    <a   class="nav-link" href="/signup">Registrarse </a>
                                </div>
        
                            </form>
        
                        </div>
                        
                        
                    </div>
                </div>
            </header>
        
            
        </body>
        
        </html>
        
        
            
        
        
        
            



    



    