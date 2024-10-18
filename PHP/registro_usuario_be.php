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

    $nombre_completo = $_POST['nombre_completo'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $peso = $_POST['peso'];
    $estatura= $_POST['estatura'];
    $edad = $_POST['edad'];
    $num_identificacion = $_POST['num_identificacion'];
    $contrasena = $_POST['contrasena'];
    $tipo_usuario = $_POST['tipo_usuario'];
    $id_profesional = $_POST['id_profesional'];
    
    //Encriptamiento de contraseña
    $contrasena = hash('sha512', $contrasena);

    $query = "INSERT INTO usuarios(nombre_completo, telefono, direccion, peso, estatura, edad, num_identificacion, contrasena, tipo_usuario, id_profesional) 
              VALUES('$nombre_completo', '$telefono', '$direccion', '$peso', '$estatura', '$edad', '$num_identificacion', '$contrasena', '$tipo_usuario', '$id_profesional')";
    
    //Verificar que el numero de indentificación no se repita
    $verificar_identificacion = mysqli_query($conexion, "SELECT * FROM usuarios WHERE num_identificacion = '$num_identificacion' ");

    if(mysqli_num_rows($verificar_identificacion) > 0){

        echo ' 
            <script>
                alert("Este número de identificación ya esta registrado, intenta con otro.")
                window.location = "../registrar.php"
            </script>
        ';
        exit();
    }

    $ejecutar = mysqli_query($conexion,$query);

    if($ejecutar){
        echo '
            <script>
                alert("Usuario almacenado exitosamente");
                window.location = "../registrar.php";
            </script>
        ';
        
    } else {
        echo '
            <script>
                alert("Inténtalo de nuevo, usuario no almacenado");
                window.location = "../registrar.php";
            </script>
        ';
    }

    mysqli_close($conexion);
?>
