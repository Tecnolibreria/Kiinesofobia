<?php

session_start(); 
include 'conexion_be.php';
$idenuser = $_SESSION['usuario'];
$consultar_tipo_profe =  mysqli_query($conexion , "SELECT  nombre_completo, tipo_usuario FROM usuarios WHERE num_identificacion = '$idenuser'");
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

}elseif ($row2["tipo_usuario"] != "Paciente") {
    echo'
        <script>
            alert("Debes iniciar sesión como Profesional");
            window.location.replace("../Home.html");
        </script>
    ';
    session_destroy();
    die();
}

$identificacion = $idenuser;
$nombre = $row2["nombre_completo"];
$p1 = $_POST['pregunta1'];
$p2 = $_POST['pregunta2'];
$p3 = $_POST['pregunta3'];
$p4 = $_POST['pregunta4'];
$p5 = $_POST['pregunta5'];
$p6 = $_POST['pregunta6'];
$p7 = $_POST['pregunta7'];
$p8 = $_POST['pregunta8'];
$p9 = $_POST['pregunta9'];
$p10 = $_POST['pregunta10'];
$p11 = $_POST['pregunta11'];
$total = $p1 + $p2 + $p3 + $p4 + $p5 + $p6 + $p7 + $p8 + $p9 + $p10 + $p11;

date_default_timezone_set('America/Bogota');
$fecha = date("Y-m-d H:i:s");

$query = "INSERT INTO escala(p1, p2, p3, p4, p5, p6, p7, p8, p9, p10, p11, total, nombre, identificacion, fecha) 
               VALUES('$p1', '$p2', '$p3', '$p4', '$p5', '$p6', '$p7', '$p8', '$p9', '$p10', '$p11', '$total', '$nombre', '$identificacion', '$fecha')";


$ejecutar = mysqli_query($conexion,$query);
 
if($ejecutar){
    echo '
        <script>
            alert("Test realizado correctamente");
            window.location = "../inicio-paciente.php";
        </script>
    ';
    
} else {
    echo '
        <script>
            alert("El test no se realizó, intentalo nuevamente");
            window.location = "../escala.php";
        </script>
    ';
}

mysqli_close($conexion);

?>