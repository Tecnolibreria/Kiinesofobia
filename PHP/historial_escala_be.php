<?php

session_start(); 
include 'conexion_be.php';
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


$campo = isset($_POST['searchValue']) ? $conexion->real_escape_string($_POST['searchValue']) : null;
 

$sql = "SELECT * FROM escala WHERE (identificacion LIKE '%".$campo."%') ";
$resultado = $conexion ->query($sql);
$num_rows = $resultado->num_rows;

$html = '';

if($num_rows > 0){
    while ($row = $resultado->fetch_assoc()) {
        $html .= '<tr>'; 
        $html .= '<td>'.$row['nombre']. '</td>';
        $html .= '<td>'.$row['identificacion']. '</td>';
        $html .= '<td>'.$row['fecha']. '</td>';
        $html .= '<td>'.$row['p1']. '</td>';
        $html .= '<td>'.$row['p2']. '</td>';
        $html .= '<td>'.$row['p3']. '</td>';
        $html .= '<td>'.$row['p4']. '</td>';
        $html .= '<td>'.$row['p5']. '</td>';
        $html .= '<td>'.$row['p6']. '</td>';
        $html .= '<td>'.$row['p7']. '</td>';
        $html .= '<td>'.$row['p8']. '</td>';
        $html .= '<td>'.$row['p9']. '</td>';
        $html .= '<td>'.$row['p10']. '</td>';
        $html .= '<td>'.$row['p11']. '</td>';
        $html .= '<td>'.$row['total']. '</td>';
        $html .= '</tr>';
    }
}else {
    $html .= '<tr>'; 
    $html .= '<td colspan="15">Sin resultados</td>';
    $html .= '</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);

?>