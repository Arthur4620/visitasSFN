<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/css/all.min.css">
    <link rel="icon" href="public/img/icono.png">
    <link rel="stylesheet" href="public/css/normalize.css">
    <link rel="stylesheet" href="public/css/main2.css">
    <title>Iniciar Sesión</title>
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
                   <?php
                            if(isset($errorLogin)){
                                echo $errorLogin; 
                            }
                        ?>
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


    



    