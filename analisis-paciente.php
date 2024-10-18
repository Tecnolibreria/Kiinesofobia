<?php
    session_start();
    include 'PHP/conexion_be.php';
    $fecha_usu = $_GET['fecha'];

    $idenuser = $_SESSION['usuario'];
    $consultar_tipo_profe =  mysqli_query($conexion , "SELECT nombre_completo, tipo_usuario FROM usuarios WHERE num_identificacion = '$idenuser'");
    $row = $consultar_tipo_profe->fetch_assoc();

    $columns = [ 'flexion_h', 'extension_h', 'abduccion_h', 'abduccion_horizontal_h', 'rotacion_int_h', 'rotacion_ext_h', 'flexion_c', 'extension_c', 'fecha'];
    $query = mysqli_query($conexion , "SELECT ". implode(", ", $columns) ."   FROM analisis_pacientes WHERE identificacion = '$idenuser' and fecha = '$fecha_usu'");
    $record = $query->fetch_assoc();

    if (!isset($_SESSION['usuario'])){

        echo'
            <script>
                alert("Debes iniciar sesión");
                window.location.replace("Home.html");
            </script>
        ';
        session_destroy();
        die();
    }elseif ($row["tipo_usuario"] != "Paciente") {
        echo'
        <script>
            alert("Debes iniciar sesión como Paciente");
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
<body>
    <header class="header-inicio ">
        <div class="caja">
            <h1> <img src="Imagenes/logo1.png" alt="Logo pagina BiomecApp" width="200px" height="200px"> </h1>
            <nav>
                <ul> 
                    <li> <a href="inicio-paciente.php">&#129104; Volver</a> </li>
                    <li > <a   href="PHP/cerrar_sesion.php">Cerrar Sesión</a></li>
                </ul>
            </nav> 
        </div>
    </header>
    
    <main class="main-paciente">
        <div class="tiulos-paciente">
            <h2>Rangos Normales</h2>
            <h3>Rangos Del Paciente</h3>
        </div>
        
        <div class="caja-forms-paciente">
            <form class="form-datosnormales">
                <fieldset class="fiel-paciente">
                    <legend>Movilidad del Hombro</legend>
                    <label for="flexion">Flexión</label>
                    <input type="text" id="flexion-hombro-normal" class="datos-comparar" value="180°" readonly>
                    <label for="flexion">Extensión</label>
                    <input type="text" id="extension-hombro-normal" class="datos-comparar" value="55°" readonly>
                    <label for="flexion">Abducción</label>
                    <input type="text" id="abduccion-hombro-normal" class="datos-comparar" value="180°" readonly>
                    <label for="flexion">Abducción Horizontal</label>
                    <input type="text" id="abdu-horizontal-hombro-normal" class="datos-comparar" value="125°" readonly>
                    <label for="flexion">Rotación Interna</label>
                    <input type="text" id="rot-int-hombro-normal" class="datos-comparar" value="85°" readonly>
                    <label for="flexion">Rotación Externa</label>
                    <input type="text" id="rot-ext-hombro-normal" class="datos-comparar" value="90°" readonly>
                </fieldset>
                <fieldset class="fiel-paciente2">
                    <legend class="titulo-codo">Movilidad del Codo</legend>
                    <label for="flexion">Flexión</label>
                    <input type="text" id="flexion-codo-normal" class="datos-comparar" value="145°" readonly>
                    <label for="flexion">Extensión</label>
                    <input type="text" id="extension-codo-normal" class="datos-comparar" value="0°" readonly>
                </fieldset>
            </form>

            <form name="form-datospaciente" class="form-datospaciente" id="form-datospaciente">
                <fieldset class="fiel-paciente">
                    <legend>Movilidad del Hombro</legend>
                    <label for="flexion">Flexión</label>
                    <input type="text" id="flexion-hombro-paciente" value="<?php echo $record['flexion_h'] ?>" name="flexion_h" class="datos-comparar" required >
                    <label for="flexion">Extensión</label>
                    <input type="text" id="extension-hombro-paciente" value="<?php echo $record['extension_h'] ?>" name="extension_h" class="datos-comparar" required>
                    <label for="flexion">Abducción</label>
                    <input type="text" id="abduccion-hombro-paciente" value="<?php echo $record['abduccion_h'] ?>" name="abduccion_h" class="datos-comparar" required>
                    <label for="flexion">Abducción Horizontal</label>
                    <input type="text" id="abdu-horizontal-hombro-paciente" value="<?php echo $record['abduccion_horizontal_h'] ?>" name="abduccion_horizontal_h" class="datos-comparar" required >
                    <label for="flexion">Rotación Interna</label>
                    <input type="text" id="rot-int-hombro-paciente" name="rotacion_int_h" value="<?php echo $record['rotacion_int_h'] ?>" class="datos-comparar" required>
                    <label for="flexion">Rotación Externa</label>
                    <input type="text" id="rot-ext-hombro-paciente" name="rotacion_ext_h" value="<?php echo $record['rotacion_ext_h'] ?>" class="datos-comparar" required>
                </fieldset>
                <fieldset class="fiel-paciente2">
                    <legend class="titulo-codo">Movilidad del Codo</legend>
                    <label for="flexion">Flexión</label>
                    <input type="text" id="flexion-codo-paciente" name="flexion_c" value="<?php echo $record['flexion_c'] ?>" class="datos-comparar" required>
                    <label for="flexion">Extensión</label>
                    <input type="text" id="extension-codo-paciente" name="extension_c" value="<?php echo $record['extension_c'] ?>" class="datos-comparar" required>
                </fieldset>
                    <input type="button" value="Analizar" id="analizar" name="analizar" onclick="analisis()">
                    <input type="button" value="Nuevo Análisis" id="reiniciar" disabled onclick="limpiar()">
            </form>
        </div>
    </main>

    <footer>
        <img src="Imagenes/logo1.png" alt="Logo pagina BiomecApp" width="200px" height="200px"> 
        <p class="copyright">&copy Copyright BiomecApp - 2024</p>
    </footer>
    <script src="app.js">  </script>
</body>
</html>