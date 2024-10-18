<?php
    session_start();
    include 'PHP/conexion_be.php';
    $id_usu = $_GET['id'];
    
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
                    <li> <a href="inicio-profesional.php">&#129104; Volver</a></li>
                    <li > <a   href="PHP/cerrar_sesion.php">Cerrar Sesión</a></li>
                </ul>
            </nav> 
        </div>
    </header>
    
    <main class="main-profesional">
        <div class = "tabla_h">
            <table class="tabla_profesional" id ="tabla_pro_h">
                <thead >
                    <tr> 
                        <th>NOMBRE</th>
                        <th>IDENTIFICACIÓN</th>
                        <th>FECHA</th>
                        <th>P-1</th>
                        <th>P-2</th>
                        <th>P-3</th>
                        <th>P-4</th>
                        <th>P-5</th>
                        <th>P-6</th>
                        <th>P-7</th>
                        <th>P-8</th>
                        <th>P-9</th>
                        <th>P-10</th>
                        <th>P-11</th>
                        <th>TOTAL</th>
                    </tr>
                </thead>

                <tbody id = "contenido">

                </tbody>
        
            <script>
                getData(<?php echo $id_usu ?>)

                function getData(searchValue) {
                    let contenido = document.getElementById("contenido");
                    let url = "PHP/historial_escala_be.php";
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

    </main>

    <footer>
        <img src="Imagenes/logo1.png" alt="Logo pagina BiomecApp" width="200px" height="200px"> 
        <p class="copyright">&copy Copyright BiomecApp - 2024</p>
    </footer>
    <script src="app.js"></script>
</body>
</html>