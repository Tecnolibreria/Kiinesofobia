<?php

    include 'conexion_be.php';
    session_start();
    $idenuser = $_SESSION['usuario'];
    $consultar_tipo_profe =  mysqli_query($conexion , "SELECT  tipo_usuario FROM administradores WHERE num_identificacion = '$idenuser'");
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
    }elseif ($row2["tipo_usuario"] != "Administrador") {
        echo'
        <script>
            alert("Debes iniciar sesión como Administrador");
            window.location.replace("../Home.html");
        </script>
    ';
    session_destroy();
    die();
    }

    $nombre_completo = $_POST['nombre_completo'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $num_identificacion = $_POST['num_identificacion'];
    $contrasena = $_POST['contrasena'];
    $tipo_usuario = $_POST['tipo_usuario'];

     //Encriptamiento de contraseña
     $contrasena = hash('sha512', $contrasena);

     $query = "INSERT INTO profesionales(nombre_completo, telefono, direccion, num_identificacion, contrasena, tipo_usuario) 
               VALUES('$nombre_completo', '$telefono', '$direccion', '$num_identificacion', '$contrasena', '$tipo_usuario')";
     
     //Verificar que el numero de indentificación no se repita
     $verificar_identificacion = mysqli_query($conexion, "SELECT * FROM profesionales WHERE num_identificacion = '$num_identificacion' ");
 
     if(mysqli_num_rows($verificar_identificacion) > 0){
 
         echo ' 
             <script>
                 alert("Este número de identificación ya esta registrado, intenta con otro.")
                 window.location = "../registrar_admin.php"
             </script>
         ';
         exit();
     }
 
     $ejecutar = mysqli_query($conexion,$query);
 
     if($ejecutar){
         echo '
             <script>
                 alert("usuario almacenado exitosamente");
                 window.location = "../registrar_admin.php";
             </script>
         ';
         
     } else {
         echo '
             <script>
                 alert("Inténtalo de nuevo, usuario no almacenado");
                 window.location = "../registrar_admin.php";
             </script>
         ';
     }
 
     mysqli_close($conexion);
?>