<?php
    session_start();
    include 'PHP/conexion_be.php';
    
    $idenuser = $_SESSION['usuario'];
    $consultar_tipo_profe =  mysqli_query($conexion , "SELECT nombre_completo, tipo_usuario FROM profesionales WHERE num_identificacion = '$idenuser'");
    $row2 = $consultar_tipo_profe->fetch_assoc();

    if (!isset($_SESSION['usuario'])){

        echo'
            <script>
                alert("Debes iniciar sesión");
                window.location.replace("Home.html");
            </script>
        ';
        session_destroy();
        die();
    }elseif ($row2["tipo_usuario"] != "Profesional") {
        echo'
        <script>
            alert("Debes iniciar sesión como Profesional");
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
                    <li> <a href="inicio-profesional.php">&#129104; Volver</a> </li>
                </ul>
            </nav> 
        </div>
    </header>

    <main>
        <form class="form-iniciosesion" method="POST" action="PHP/registro_usuario_be.php">
            <fieldset >
            <label for="nombrecompleto">Nombre Completo</label>
            <input type="text" id="nombresr" class="input-padron" name="nombre_completo" required> 

            <label for="telefono">Número de Telefono</label>
            <input type="tel" id="telefonor" class="input-padron" name="telefono" required >

            <label for="direccion">Dirección</label>
            <input type="text" id="direccionr" class="input-padron" name="direccion" required >

            <label for="peso">Peso</label>
            <input type="text" id="pesor" class="input-padron" name="peso" required placeholder="En Kilogramos">

            <label for="estatura">Estatura</label>
            <input type="text" id="estaturar" class="input-padron" name="estatura" required placeholder="En Centimetros(cm)">

            <label for="edad">Edad</label>
            <input type="text" id="edadr" class="input-padron" name="edad" required >

            <label for="indentifacion">Número de Identificación</label>
            <input type="text" id="identifacionr" class="input-padron" name="num_identificacion" required placeholder="Sin Puntos Ni Espacios">

            <label for="contraseña">Contraseña</label>
            <input type="password" id="contrasenar" class="input-padron" name="contrasena"  required> 

            <label for="tipousuario">Tipo de Usuario</label>
                    <select name="tipo_usuario">
                        <option>Paciente</option>
                    </select>
             
            <label for="idprofe">Número de Identificación del Profesional</label>
            <input type="text" id="id_profe" class="input-padron" name="id_profesional"  required>         
            </fieldset>

            <input type="submit" value="Registrar" class="ingresar" name="registrar" >
        </form>
    </main>
    <script src="app.js"></script>
</body>
</html>