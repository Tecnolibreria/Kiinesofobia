<?php
    session_start();
    include 'PHP/conexion_be.php';
    
    $idenuser = $_SESSION['usuario'];
    $consultar_tipo_profe =  mysqli_query($conexion , "SELECT  tipo_usuario FROM administradores WHERE num_identificacion = '$idenuser'");
    $row = $consultar_tipo_profe->fetch_assoc();


    if (!isset($_SESSION['usuario'])){

        echo'
            <script>
                alert("Debes iniciar sesión");
                window.location.replace("Home.html");
            </script>
        ';
        session_destroy();
        die();
    }elseif ($row["tipo_usuario"] != "Administrador") {
        echo'
        <script>
            alert("Debes iniciar sesión como Administrador");
            window.location.replace("Home.html");
        </script>
        
    ';
        session_destroy();
        die();
    }
?> 

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <title>BiomecApp</title>
</head>
<body id="body-inicio-sesion">
    <header class="header-sesion">
        <div class="caja">
            <h1> <img src="Imagenes/logo1.png" alt="Logo pagina BiomecApp" width="200px" height="200px"> </h1>
            <nav>
                <ul> 
                    <li> <a href="PhP/cerrar_sesion.php">&#129104; Volver</a> </li>
                </ul>
            </nav> 
        </div>
    </header>

    <main>
        <form class="form-iniciosesion" method="POST" action="PHP/registro_profesionales_be.php">
            <fieldset >
            <label for="nombrecompleto">Nombre Completo</label>
            <input type="text" id="nombresr" class="input-padron" name="nombre_completo" required> 

            <label for="telefono">Número de Telefono</label>
            <input type="tel" id="telefonor" class="input-padron" name="telefono" required >

            <label for="direccion">Dirección</label>
            <input type="text" id="direccionr" class="input-padron" name="direccion" required >

            <label for="indentifacion">Número de Identificación</label>
            <input type="text" id="identifacionr" class="input-padron" name="num_identificacion" required placeholder="Sin Puntos Ni Espacios">

            <label for="contraseña">Contraseña</label>
            <input type="password" id="contrasenar" class="input-padron" name="contrasena"  required> 

            <label for="indentifacion">Tipo de Usuario</label>
                    <select name="tipo_usuario">
                        <option>Profesional</option>
                    </select>
            </fieldset>

            <input type="submit" value="Registrar" class="ingresar" name="registrar" >
        </form>
    </main>
    <script src="app.js"></script>
</body>
</html>