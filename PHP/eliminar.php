<?php
    session_start();
    include 'conexion_be.php';
    $id_usu = $_GET['id'];

    $idenuser = $_SESSION['usuario'];
    $consultar_tipo_profe =  mysqli_query($conexion , "SELECT  tipo_usuario FROM profesionales WHERE num_identificacion = '$idenuser'");
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

    $query = mysqli_query($conexion , "DELETE FROM usuarios WHERE num_identificacion = '$id_usu'");
    $query2 = mysqli_query($conexion , "DELETE FROM analisis_pacientes  WHERE identificacion = '$id_usu'");

    echo'
        <script>
            alert("Usuario eliminado con exito");
            window.location.replace("../inicio-profesional.php");
        </script>
    ';

?> 