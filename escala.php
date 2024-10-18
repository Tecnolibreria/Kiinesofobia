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
                    <li> <a href="inicio-paciente.php">&#129104; Volver</a></li>
                    <li > <a  href="PHP/cerrar_sesion.php">Cerrar Sesión</a></li>
                </ul>
            </nav> 
        </div>
    </header>

    <main class="main-escala">
        <h2 align="center" >CUESTIONARIO TSK-11SV</h2>
        <p><strong>INSTRUCCIONES:</strong> a continuacion se enumeran una serie de afirmaciones. Lo que usted ha de hacer, es indicar qué punto eso ocurre en su caso según la siguiente pregunta.</p>
        <p id="exp-escala"><strong>1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4
        </strong></p>
        <p id="exp-escala2"><strong>Totalmente en desacuerdo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Toalmente de acuerdo
        </strong></p>


        <form method="POST" action="PHP/registro_escala.php">
            <fieldset class="fiel-escala">
                <legend>1.  Tengo miedo de lesionarme si hago ejercicio físico.</legend>
                <label for="radio-P1"><input type="radio" name="pregunta1" value="1" id="radio-p1-1" required>1</label>
                <label for="radio-P1"><input type="radio" name="pregunta1" value="2" id="radio-p1-2" required>2</label>
                <label for="radio-P1"><input type="radio" name="pregunta1" value="3" id="radio-p1-3" required>3</label>
                <label for="radio-P1"><input type="radio" name="pregunta1" value="4" id="radio-p1-4" required>4</label>
            
                <legend>2.  Si me dejara vencer por el dolor, el dolor aumenatria.</legend>
                <label for="radio-P2"><input type="radio" name="pregunta2" value="1" id="radio-p2-1" required>1</label>
                <label for="radio-P2"><input type="radio" name="pregunta2" value="2" id="radio-p2-2" required>2</label>
                <label for="radio-P2"><input type="radio" name="pregunta2" value="3" id="radio-p2-3" required>3</label>
                <label for="radio-P2"><input type="radio" name="pregunta2" value="4" id="radio-p2-4" required>4</label>

                <legend>3.  mi cuerpo me está diciendo que tengo algo serio.</legend>
                <label for="radio-P3"><input type="radio" name="pregunta3" value="1" id="radio-p3-1" required>1</label>
                <label for="radio-P3"><input type="radio" name="pregunta3" value="2" id="radio-p3-2" required>2</label>
                <label for="radio-P3"><input type="radio" name="pregunta3" value="3" id="radio-p3-3" required>3</label>
                <label for="radio-P3"><input type="radio" name="pregunta3" value="4" id="radio-p3-4" required>4</label>

                <legend>4.  Tener dolor siempre quiere decir que en el cuerpo hay una lesión. </legend>
                <label for="radio-P1"><input type="radio" name="pregunta4" value="1" id="radio-p4-1" required>1</label>
                <label for="radio-P1"><input type="radio" name="pregunta4" value="2" id="radio-p4-2" required>2</label>
                <label for="radio-P1"><input type="radio" name="pregunta4" value="3" id="radio-p4-3" required>3</label>
                <label for="radio-P1"><input type="radio" name="pregunta4" value="4" id="radio-p4-4" required>4</label>

                <legend>5.  Tengo miedo a lesionarme sin querer.</legend>
                <label for="radio-P1"><input type="radio" name="pregunta5" value="1" id="radio-p5-1" required>1</label>
                <label for="radio-P1"><input type="radio" name="pregunta5" value="2" id="radio-p5-2" required>2</label>
                <label for="radio-P1"><input type="radio" name="pregunta5" value="3" id="radio-p5-3" required>3</label>
                <label for="radio-P1"><input type="radio" name="pregunta5" value="4" id="radio-p5-4" required>4</label>

                <legend>6.  Lo más seguro para evitar que aumente el dolor es tener cuidado y no hacer movimientos innecesarios.</legend>
                <label for="radio-P1"><input type="radio" name="pregunta6" value="1" id="radio-p6-1" required>1</label>
                <label for="radio-P1"><input type="radio" name="pregunta6" value="2" id="radio-p6-2" required>2</label>
                <label for="radio-P1"><input type="radio" name="pregunta6" value="3" id="radio-p6-3" required>3</label>
                <label for="radio-P1"><input type="radio" name="pregunta6" value="4" id="radio-p6-4" required>4</label>

                <legend>7.  No me dolería tanto si no tuviese algo serio en mi cuerpo.</legend>
                <label for="radio-P1"><input type="radio" name="pregunta7" value="1" id="radio-p7-1" required>1</label>
                <label for="radio-P1"><input type="radio" name="pregunta7" value="2" id="radio-p7-2" required>2</label>
                <label for="radio-P1"><input type="radio" name="pregunta7" value="3" id="radio-p7-3" required>3</label>
                <label for="radio-P1"><input type="radio" name="pregunta7" value="4" id="radio-p7-4" required>4</label>

                <legend>8.  El dolor me dice cuándo dedo para la actividad para no lesionarme.</legend>
                <label for="radio-P1"><input type="radio" name="pregunta8" value="1" id="radio-p8-1" required>1</label>
                <label for="radio-P1"><input type="radio" name="pregunta8" value="2" id="radio-p8-2" required>2</label>
                <label for="radio-P1"><input type="radio" name="pregunta8" value="3" id="radio-p8-3" required>3</label>
                <label for="radio-P1"><input type="radio" name="pregunta8" value="4" id="radio-p8-4" required>4</label>

                <legend>9.  No es seguro para una persona con mi enfermedad hacer actividades físicas.</legend>
                <label for="radio-P1"><input type="radio" name="pregunta9" value="1" id="radio-p9-1" required>1</label>
                <label for="radio-P1"><input type="radio" name="pregunta9" value="2" id="radio-p9-2" required>2</label>
                <label for="radio-P1"><input type="radio" name="pregunta9" value="3" id="radio-p9-3" required>3</label>
                <label for="radio-P1"><input type="radio" name="pregunta9" value="4" id="radio-p9-4" required>4</label>

                <legend>10. No puedo hacer todo lo que la gente normal hace porque me podría lesionar con facilidad.</legend>
                <label for="radio-P1"><input type="radio" name="pregunta10" value="1" id="radio-p10-1" required>1</label>
                <label for="radio-P1"><input type="radio" name="pregunta10" value="2" id="radio-p10-2" required>2</label>
                <label for="radio-P1"><input type="radio" name="pregunta10" value="3" id="radio-p10-3" required>3</label>
                <label for="radio-P1"><input type="radio" name="pregunta10" value="4" id="radio-p10-4" required>4</label>

                <legend>11. nadie bedería hacer actividades físicas cuando tiene dolor.</legend>
                <label for="radio-P1"><input type="radio" name="pregunta11" value="1" id="radio-p11-1" required>1</label>
                <label for="radio-P1"><input type="radio" name="pregunta11" value="2" id="radio-p11-2" required>2</label>
                <label for="radio-P1"><input type="radio" name="pregunta11" value="3" id="radio-p11-3" required>3</label>
                <label for="radio-P1"><input type="radio" name="pregunta11" value="4" id="radio-p11-4" required>4</label>
            </fieldset>
            <input type="submit" value="Enviar" id="enviar-escala" class="ingresar">
        </form>
    </main>

    <footer>
        <img src="Imagenes/logo1.png" alt="Logo pagina BiomecApp" width="200px" height="200px"> 
        <p class="copyright">&copy Copyright BiomecApp - 2024</p>
    </footer>
    <script src="app.js"></script>
</body>
</html>

