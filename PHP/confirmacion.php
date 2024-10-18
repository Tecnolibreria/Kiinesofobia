<?php
    session_start();
    include 'conexion_be.php';
    $id_usu = $_GET['id'];

    $idenuser = $_SESSION['usuario'];
    $consultar_tipo_profe =  mysqli_query($conexion , "SELECT  tipo_usuario FROM profesionales WHERE num_identificacion = '$idenuser'");
    $row2 = $consultar_tipo_profe->fetch_assoc();
    $query = mysqli_query($conexion , "SELECT  nombre_completo FROM usuarios WHERE num_identificacion = '$id_usu'");
    $record = $query->fetch_assoc();

    $nombre = $record['nombre_completo'];

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

    echo'
        <script>
            var r = confirm("¿Desea realmente borrar los registros de '.$nombre.'?");
            if (r== true){
                window.location = "eliminar.php'. '?id='.$id_usu.'";
            }else{
                window.location = "../inicio-profesional.php";
            }
        </script>
    ';  
    

?> 
