<?php

session_start(); 
include 'conexion_be.php';
$idenuser = $_SESSION['usuario'];
$consultar_tipo_profe =  mysqli_query($conexion , "SELECT nombre_completo, tipo_usuario FROM profesionales WHERE num_identificacion = '$idenuser'");
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

$columns =  ['nombre_completo',	'telefono',	'direccion', 'peso', 'estatura', 'edad', 'num_identificacion', 'tipo_usuario',	
            'id_profesional'];
$columns2 =  ['num_identificacion', 'nombre_completo'];            
$table = "usuarios";    

$campo = isset($_POST['busqueda_pro'])? $conexion->real_escape_string($_POST['busqueda_pro']) : null;

$where = '';

if ($campo != null) {
    $cont = count($columns2);
    for ($i = 0; $i < $cont; $i++) {
        $where .= $columns2[$i] ." LIKE '%". $campo . "%' OR ";
    }
    $where = substr_replace($where,"",-3); 
    $where .= " and ";
    
}

$sql = "SELECT ". implode(", ", $columns) ." FROM $table WHERE ( $where id_profesional = $idenuser)";
$resultado = $conexion ->query($sql);
$num_rows = $resultado->num_rows;

$html = '';

if($num_rows > 0){
    while ($row = $resultado->fetch_assoc()) {
        $id_usuario = $row['num_identificacion'];
        $html .= '<tr>'; 
        $html .= '<td>'.$row['num_identificacion']. '</td>';
        $html .= '<td>'.$row['nombre_completo']. '</td>';
        $html .= '<td>'.$row['telefono']. '</td>';
        $html .= '<td>'.$row['direccion']. '</td>';
        $html .= '<td>'.$row['peso']. '</td>';
        $html .= '<td>'.$row['estatura']. '</td>';
        $html .= '<td>'.$row['edad']. '</td>';
        $html .= '<td>'.$row['tipo_usuario']. '</td>';
        $html .= '<td>'.$row['id_profesional']. '</td>';
        $html .= '<td><a class = "btn-analizar" href="analisis-profesional.php'. '?id='.$id_usuario.'" >Análisis</a></td>';
        $html .= '<td><a class = "btn-historial" href="historial_profesional.php'. '?id='.$id_usuario.'" >Historial</a></td>';
        $html .= '<td><a class = "btn-escala" href="historial_escala.php'. '?id='.$id_usuario.'" >Escala</a></td>';
        $html .= '<td><a class = "btn-eliminar" href="PHP/confirmacion.php'. '?id='.$id_usuario.'" >&#128465;</a></td>';
        $html .= '</tr>';
    }
}else {
    $html .= '<tr>'; 
    $html .= '<td colspan="10">Sin resultados</td>';
    $html .= '</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);

?>