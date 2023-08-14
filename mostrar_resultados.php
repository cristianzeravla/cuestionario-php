<?php
session_start();

// Obtener las preguntas y respuestas del juego seleccionado
$preguntas_juego = isset($_SESSION['preguntas_juego']) ? $_SESSION['preguntas_juego'] : array();

// Calcular el puntaje del usuario
$puntuacion = 0;

// Calcular el número total de preguntas
$totalPreguntas = count($preguntas_juego);

// Obtener las respuestas del usuario desde la sesión
$respuestasUsuario = isset($_SESSION['respuestasUsuario']) ? $_SESSION['respuestasUsuario'] : array();

foreach ($preguntas_juego as $indice => $pregunta) {
    $nombreRespuesta = 'pregunta' . ($indice + 1);
    if (isset($_POST[$nombreRespuesta])) {
        $respuestasUsuario[$indice] = $pregunta['opciones'][$_POST[$nombreRespuesta]];
        
    } else {
        $respuestasUsuario[$indice] = 'Sin responder';
    }
}

foreach ($preguntas_juego as $indice => $pregunta) {
    $nombreRespuesta = 'pregunta' . ($indice + 1);

    if (isset($_POST[$nombreRespuesta])) {
        $respuestaUsuario = $_POST[$nombreRespuesta];

        if ($respuestaUsuario === $pregunta['correcta']) {
            $puntuacion++;
        }
    }
}

// Almacenar la puntuación en la sesión
$_SESSION['puntuacion'] = $puntuacion;

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados del Cuestionario</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Resultados del Cuestionario</h2>
        <p>Tu puntuación: <?php echo $puntuacion; ?>/<?php echo $totalPreguntas; ?></p>
        <h3>Preguntas y respuestas</h3>
        <ul>
            <?php
            foreach ($preguntas_juego as $indice => $pregunta) {
                $respuestaUsuario = isset($respuestasUsuario[$indice]) ? $respuestasUsuario[$indice] : 'Sin responder';
                $respuestaCorrecta = $pregunta['opciones'][$pregunta['correcta']];
                
                echo '<li>';
                echo '<p><strong>Pregunta:</strong> ' . $pregunta['pregunta'] . '</p>';
                echo '<p><strong>Tu respuesta:</strong> ' . $respuestaUsuario . '</p>';
                echo '<p><strong>Respuesta correcta:</strong> ' . $respuestaCorrecta . '</p>';
                echo '</li>';
            }

            ?>
        </ul>
        <a href="index.html"><button id="submitBtn">Volver al Inicio</button></a>
    </div>
    <footer>
        <p>Desarrollado por Cristian Esteban Alvarez Peña</p>
        <div class="social-links">
            <a href="https://www.linkedin.com/in/cristianzeravla/" target="_blank">LinkedIn</a>
            <a href="https://github.com/cristianzeravla"target="_blank">GitHub</a>
        </div>
    </footer>
</body>
</html>