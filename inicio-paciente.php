<?php
    session_start();
    include 'PHP/conexion_be.php';
    
    $idenuser = $_SESSION['usuario'];
    $consultar_tipo_profe =  mysqli_query($conexion , "SELECT nombre_completo, tipo_usuario FROM usuarios WHERE num_identificacion = '$idenuser'");
    $row = $consultar_tipo_profe->fetch_assoc();

    if (!isset($_SESSION['usuario'])){

        echo'
            <script>
                alert("Debes iniciar sesión");
                window.location.replace("Home.html");
            </script>
        ';
        session_destroy();
        die();
    }elseif ($row["tipo_usuario"] != "Paciente") {
        echo'
        <script>
            alert("Debes iniciar sesión como Paciente");
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
                    <li > <a   href="PHP/cerrar_sesion.php">Cerrar Sesión</a></li>
                </ul>
            </nav> 
        </div>
    </header>
    
    <main class="main-paciente2">
        <div class="bienvenida_p" >
            <p>Bienvenido <?php echo $row["nombre_completo"] ?>. Este es tu historial de analisis:</p>
        </div>

        <div class="tabla_h2">
        <table class="tabla_profesional" id ="tabla_pro_h">
            <thead >
                <tr> 
                    <th>IDENTIFICACIÓN</th>
                    <th>FLEXIÓN HOMBRO</th>
                    <th>EXTENSIÓN HOMBRO</th>
                    <th>ABDUCCIÓN HOMBRO</th>
                    <th>ABDUCCIÓN HORIZONTAL HOMBRO</th>
                    <th>ROTACIÓN INTERNA HOMBRO</th>
                    <th>ROTACIÓN EXTERNA HOMBRO</th>
                    <th>FLEXIÓN CODO</th>
                    <th>EXTENSIÓN CODO</th>
                    <th>FECHA</th>
                    <th>FUNCIÓN</th>
                </tr>
            </thead>

            <tbody id = "contenido">

            </tbody>

            <script>
                getData(<?php echo $idenuser ?>)

                function getData(searchValue) {
                    let contenido = document.getElementById("contenido");
                    let url = "PHP/historial_paciente_be.php";
                    let fromData = new FormData();
                    fromData.append('searchValue', searchValue);

                    fetch(url, {
                        method: "POST",
                        body: fromData
                    }).then(response => response.json())
                    .then(data => {
                        contenido.innerHTML = data;
                    }).catch(err => console.log(err));
                }
            </script>
            
        </table>
        </div>        
        <div class="invitacion">
            <p>Te inivitamos a realizar nuestro cuestionario de Kinesofobia:</p>
            <input type="button" value="Haz el Test" id="kinesofobia" onclick="escala()">
        </div>
       
    </main>

    <footer>
        <img src="Imagenes/logo1.png" alt="Logo pagina BiomecApp" width="200px" height="200px"> 
        <p class="copyright">&copy Copyright BiomecApp - 2024</p>
    </footer>
    <script src="app.js"></script>
</body>
</html>