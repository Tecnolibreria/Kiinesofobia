<?php
    session_start();
    include 'conexion_be.php';

    $identificacion = $_POST['identificacion'];
    $contrasena = $_POST['contrasena'];
    $contrasena = hash('sha512', $contrasena);


    $validar_login_paciente = mysqli_query($conexion, "SELECT * FROM usuarios  WHERE num_identificacion = '$identificacion' and contrasena = '$contrasena' ");
    $validar_login_profesional = mysqli_query($conexion, "SELECT * FROM  profesionales WHERE num_identificacion = '$identificacion' and contrasena = '$contrasena' ");
    $validar_login_admin = mysqli_query($conexion, "SELECT * FROM  administradores WHERE num_identificacion = '$identificacion' and contrasena = '$contrasena' ");

    if(mysqli_num_rows($validar_login_paciente) > 0 || mysqli_num_rows($validar_login_profesional) > 0 || mysqli_num_rows($validar_login_admin) > 0){
        $_SESSION['usuario'] = $identificacion;
        $idenuser = $_SESSION['usuario'];

        $consultar_tipo_paciente =  mysqli_query($conexion , "SELECT  tipo_usuario FROM usuarios WHERE num_identificacion = '$idenuser'");
        $row1 = $consultar_tipo_paciente->fetch_assoc();

        $consultar_tipo_profe =  mysqli_query($conexion , "SELECT tipo_usuario FROM profesionales WHERE num_identificacion = '$idenuser'");
        $row2 = $consultar_tipo_profe->fetch_assoc();

        $consultar_tipo_admin =  mysqli_query($conexion , "SELECT  tipo_usuario FROM administradores WHERE num_identificacion = '$idenuser'");
        $row3 = $consultar_tipo_admin->fetch_assoc();
        
        /* header("location: ../inicio-paciente.php"); */

        if ($row1["tipo_usuario"] == "Paciente") {
            echo "
                <script>
                
                    window.location.replace('../inicio-paciente.php');
                </script>
            ";
            exit();
        }  
        if ($row2["tipo_usuario"] == "Profesional") {
            echo "
                <script>
                    window.location.replace('../inicio-profesional.php');
                </script>
            ";
            exit();
        }
        if ($row3["tipo_usuario"] == "Administrador") {
            echo "
                <script>
                    window.location.replace('../registrar_admin.php');
                </script>
            ";
        }
    } else{
        echo '
            <script>
                alert("El usuario no está registrado. Por favor verifique los datos introducidos.");
                window.location = "../inicio-sesion.php";
            </script>
        ';
        exit();
    }

?>
