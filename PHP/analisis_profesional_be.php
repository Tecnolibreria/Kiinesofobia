<?php
include 'conexion_be.php';
    
    session_start();

    $idenuser = $_SESSION['usuario'];
    $consultar_tipo_profe =  mysqli_query($conexion , "SELECT  tipo_usuario FROM profesionales WHERE num_identificacion = '$idenuser'");
    $row2 = $consultar_tipo_profe->fetch_assoc();

    if (!isset($_SESSION['usuario'])){

        echo'
            <script>
                alert("Debes iniciar sesión");
                window.location.replace("../Home.html");
            </script>
        ';
        session_destroy();
        die();
    }elseif ($row2["tipo_usuario"] != "Profesional") {
        echo'
        <script>
            alert("Debes iniciar sesión como Profesional");
            window.location.replace("../Home.html");
        </script>
    ';
    session_destroy();
    die();
    }

    $nombre = $_POST['nombre_usu'];
    $identificacion = $_POST['id_usuario'];
    $flexion_h = $_POST['flexion_h'];
    $extension_h = $_POST['extension_h'];
    $abduccion_h = $_POST['abduccion_h'];
    $abduccion_horizontal_h = $_POST['abduccion_horizontal_h'];
    $rotacion_int_h = $_POST['rotacion_int_h'];
    $rotacion_ext_h = $_POST['rotacion_ext_h'];
    $flexion_c = $_POST['flexion_c'];
    $extension_c = $_POST['extension_c'];

    date_default_timezone_set('America/Bogota');
    $fecha = date("Y-m-d H:i:s");



    $query = "INSERT INTO  analisis_pacientes (nombre, identificacion, flexion_h, extension_h, abduccion_h, abduccion_horizontal_h, rotacion_int_h, rotacion_ext_h, flexion_c, extension_c,  fecha) 
              VALUES('$nombre', '$identificacion', '$flexion_h', '$extension_h', '$abduccion_h', '$abduccion_horizontal_h ', '$rotacion_int_h', '$rotacion_ext_h', '$flexion_c', '$extension_c', '$fecha')";

    $ejecutar = mysqli_query($conexion,$query);

    if($ejecutar){
        echo '
            <script>
                alert("¡Análisis Realizado con Exito!");
                window.location = "../analisis-profesional.php'. '?id='.$identificacion.'";
                
            </script>
        ';
        
    } else {
        echo '
            <script>
                alert("Inténtalo de nuevo, no se pudo realizar el analisis");
                window.location = "../analisis-profesional.php'. '?id='.$identificacion.'";
            </script>
        ';
    }

    mysqli_close($conexion);



?>