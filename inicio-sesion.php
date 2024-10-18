<?php
    session_start();
    session_destroy();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="style.css">
    <link sr>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <title>BiomecApp</title>
</head>
<body id="body-inicio-sesion">
    <header class="header-sesion">
        <div class="caja">
            <h1> <img src="Imagenes/logo1.png" alt="Logo pagina BiomecApp" width="200px" height="200px"> </h1>
            <nav>
                <ul> 
                    <li> <a href="Home.html">Home</a> </li>
                    <li> <a href="">Contacto</a></li>
                </ul>
            </nav> 
        </div>
    </header>

    <main>
        <form class="form-iniciosesion" action="PHP/login_usuario_be.php" method="POST">
            <fieldset>
            <label for="indentifacion">Número de Identificación</label>
            <input type="text" id="identificacion" class="input-padron" name="identificacion" required>

            <label for="contraseña">Contraseña</label>
            <input type="password" id="contraseña" class="input-padron" name="contrasena" required> 

            </fieldset>

            <input type="submit" value="Ingresar" class="ingresar" >
        </form>
    </main>

    <script src="app.js"></script>
</body>
</html>