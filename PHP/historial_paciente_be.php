<?php

session_start(); 
include 'conexion_be.php';
$idenuser = $_SESSION['usuario'];
$consultar_tipo_profe =  mysqli_query($conexion , "SELECT  tipo_usuario FROM usuarios WHERE num_identificacion = '$idenuser'");
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


$campo = isset($_POST['searchValue']) ? $conexion->real_escape_string($_POST['searchValue']) : null;
 

$columns = [ 'identificacion', 'flexion_h', 'extension_h', 'abduccion_h', 'abduccion_horizontal_h', 'rotacion_int_h', 'rotacion_ext_h', 'flexion_c', 'extension_c', 'fecha'];

$sql = "SELECT ". implode(", ", $columns) ." FROM analisis_pacientes WHERE (identificacion LIKE '%".$campo."%') ";
$resultado = $conexion ->query($sql);
$num_rows = $resultado->num_rows;

$html = '';

if($num_rows > 0){
    while ($row = $resultado->fetch_assoc()) {
        $fecha = $row['fecha'];
        $html .= '<tr>'; 
        $html .= '<td>'.$row['identificacion']. '</td>';
        $html .= '<td>'.$row['flexion_h']. '</td>';
        $html .= '<td>'.$row['extension_h']. '</td>';
        $html .= '<td>'.$row['abduccion_h']. '</td>';
        $html .= '<td>'.$row['abduccion_horizontal_h']. '</td>';
        $html .= '<td>'.$row['rotacion_int_h']. '</td>';
        $html .= '<td>'.$row['rotacion_ext_h']. '</td>';
        $html .= '<td>'.$row['flexion_c']. '</td>';
        $html .= '<td>'.$row['extension_c']. '</td>';
        $html .= '<td>'.$row['fecha']. '</td>';
        $html .= '<td><a class = "btn-analizar" href="analisis-paciente.php'. '?fecha='.$fecha.'" >Análisis</a></td>';
        $html .= '</tr>';
    }
}else {
    $html .= '<tr>'; 
    $html .= '<td colspan="11">No tienes analisís registrados</td>';
    $html .= '</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);

?>