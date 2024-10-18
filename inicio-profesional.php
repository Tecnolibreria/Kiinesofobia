<?php
    session_start();
    include 'PHP/conexion_be.php';
    
    $idenuser = $_SESSION['usuario'];
    $consultar_tipo_profe =  mysqli_query($conexion , "SELECT nombre_completo, tipo_usuario FROM profesionales WHERE num_identificacion = '$idenuser'");
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
?>  


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <title>BiomecApp</title>
</head>
<body>
    <header class="header-inicio ">
        <div class="caja">
            <h1> <img src="Imagenes/logo1.png" alt="Logo pagina BiomecApp" width="200px" height="200px"> </h1>
            <nav>
                <ul> 
                    <li> <a href="registrar.php">Resgistrar Paciente</a></li>
                    <li > <a   href="PHP/cerrar_sesion.php">Cerrar Sesión</a></li>
                </ul>
            </nav> 
        </div>
    </header>
    
    <main class="main-profesional">

        <form name="buscar_profesional" class="buscar_profesional" id="form-datospaciente" action="" method="POST">
            <label for="busqueda_pro">Buscar:</label>
            <input type="text" class="input-busqueda" id="busqueda_pro" name="busqueda_pro" >
        </form>

        
        <table class="tabla_profesional">
            <thead >
                <tr> 
                    <th>NÚMERO DE IDENTIFICACIÓN</th>
                    <th>NOMBRE</th>
                    <th>TELÉFONO</th>
                    <th>DIRECCIÓN</th>
                    <th>PESO (Kg)</th>
                    <th>ESTATURA (Cm)</th>
                    <th>EDAD</th>
                    <th>TIPO DE USUARIO</th>
                    <th>ID PRO</th>
                    <th colspan="4">FUNCIONES</th>
                </tr>
            </thead>

            <tbody id = "contenido">

            </tbody>

            <script>
                getData()

                document.getElementById("busqueda_pro").addEventListener("keyup", getData)

                function getData(){
                    let busqueda = document.getElementById("busqueda_pro").value
                    let contenido = document.getElementById("contenido")
                    let url = "PHP/load_profesional.php"
                    let fromData = new FormData()
                    fromData.append('busqueda_pro', busqueda)

                    fetch(url, {
                        method: "POST",
                        body: fromData
                    }).then(response => response.json())
                    .then(data => {
                        contenido.innerHTML = data;
                    }).catch(err => console.log(err))
                }

                function confirmacion() {
                    var respuesta = confirm("¿Desea borrar los registros de..?");
                    if (respuesta == true){
                        return true;
                    }else{
                        return false;
                    }
                } 
            </script>
            
        </table>
        
    </main>

    <footer>
        <img src="Imagenes/logo1.png" alt="Logo pagina BiomecApp" width="200px" height="200px"> 
        <p class="copyright">&copy Copyright BiomecApp - 2024</p>
    </footer>
    <script src="app.js"></script>
</body>
</html>