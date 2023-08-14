<?php
session_start();

$preguntas = array(
    'skyrim' => array(
        array(
        'pregunta' => '¿Quién es el protagonista de Skyrim?',
        'opciones' => array(
            'a' => 'Dovahkiin',
            'b' => 'Alduin',
            'c' => 'Paarthurnax'
        ),
        'correcta' => 'a'
    ),
    array(
        'pregunta' => '¿Cuál es el nombre del dios dragón en Skyrim?',
        'opciones' => array(
            'a' => 'Alduin',
            'b' => 'Spartacus',
            'c' => 'Dovahkiin'
        ),
        'correcta' => 'a'
    ),
    array(
        'pregunta' => '¿Qué gremio se enfoca en el robo y el sigilo?',
        'opciones' => array(
            'a' => 'Compañía de los Compañeros',
            'b' => 'Gremio de los Ladrones',
            'c' => 'Gremio de los Magos'
        ),
        'correcta' => 'b'
    ),
    array(
        'pregunta' => '¿Cuál es la raza nórdica más común en Skyrim?',
        'opciones' => array(
            'a' => 'Altos Elfos',
            'b' => 'Khajiit',
            'c' => 'Nórdicos'
        ),
        'correcta' => 'c'
    ),
    array(
        'pregunta' => '¿En qué año se lanzó el juego "The Elder Scrolls V: Skyrim?"',
        'opciones' => array(
            'a' => '1600',
            'b' => '2005',
            'c' => '2010'
        ),
        'correcta' => 'c'
    )
    ),

    'witcher' => array(
        array(
        'pregunta' => '¿Quién es el protagonista de The Witcher 3?',
        'opciones' => array(
            'a' => 'Geralt de Rivia',
            'b' => 'Ciri',
            'c' => 'Yennefer'
        ),
        'correcta' => 'a'
    ),
    array(
        'pregunta' => '¿Cuál es la ciudad principal en The Witcher 3?',
        'opciones' => array(
            'a' => 'Novigrado',
            'b' => 'Velen',
            'c' => 'Oxenfurt'
        ),
        'correcta' => 'a'
    ),
    array(
        'pregunta' => '¿Cuál es el nombre del imperio en The Witcher 3?',
        'opciones' => array(
            'a' => 'Imperio Nilfgaardiano',
            'b' => 'Imperio Redaniano',
            'c' => 'Imperio Temeriano'
        ),
        'correcta' => 'a'
    ),
    array(
        'pregunta' => '¿Cuál es el oficio principal de Geralt?',
        'opciones' => array(
            'a' => 'Cazador de Monstruos',
            'b' => 'Bardista',
            'c' => 'Hechicero'
        ),
        'correcta' => 'a'
    ),
    array(
        'pregunta' => '¿En qué año se lanzó el juego "The Witcher 3: Wild Hunt?"',
        'opciones' => array(
            'a' => '2010',
            'b' => '2013',
            'c' => '2015'
        ),
        'correcta' => 'c'
    )
    ),
    
    'dragonage' => array(
        array(
        'pregunta' => '¿Cuál es el título completo del juego Dragon Age Inquisition?',
        'opciones' => array(
            'a' => 'Dragon Age: Origins',
            'b' => 'Dragon Age II',
            'c' => 'Dragon Age: Inquisition'
        ),
        'correcta' => 'c'
    ),
    array(
        'pregunta' => '¿Cuál es la facción principal en Dragon Age Inquisition?',
        'opciones' => array(
            'a' => 'Círculo de Magos',
            'b' => 'Los Templarios',
            'c' => 'La Inquisición'
        ),
        'correcta' => 'c'
    ),
    array(
        'pregunta' => '¿Cuál es el nombre del protagonista en Dragon Age Inquisition?',
        'opciones' => array(
            'a' => 'Hawke',
            'b' => 'The Warden',
            'c' => 'El Inquisidor'
        ),
        'correcta' => 'c'
    ),
    array(
        'pregunta' => '¿Cuál es el nombre de la organización secreta que manipula eventos en Dragon Age Inquisition?',
        'opciones' => array(
            'a' => 'Los Venatori',
            'b' => 'Los Qunari',
            'c' => 'Los Susurradores'
        ),
        'correcta' => 'a'
    ),
    array(
        'pregunta' => '¿En qué año se lanzó el juego "Dragon Age Inquisition?"',
        'opciones' => array(
            'a' => '2010',
            'b' => '2014',
            'c' => '2019'
        ),
        'correcta' => 'b'
    )
    ));

// Obtener el juego seleccionado desde la URL
if (isset($_GET['juego'])) {
    $juego = $_GET['juego'];
} else {
    // Redirigir al index si no se eligió un juego
    header('Location: index.html');
    exit();
}

// Verificar si el juego seleccionado es válido
if (!array_key_exists($juego, $preguntas)) {
    // Redirigir al index si el juego no es válido
    header('Location: index.html');
    exit();
}

// Obtener preguntas y respuestas del juego seleccionado
$preguntas_juego = $preguntas[$juego];

// Almacenar las preguntas y respuestas en una sesión
$_SESSION['preguntas_juego'] = $preguntas_juego;


// HTML y JavaScript para mostrar preguntas y respuestas
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuestionario - <?php echo ucfirst($juego); ?></title>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js"></script>
</head>
<body>
    <div class="container">
        <h2>Cuestionario de <?php echo ucfirst($juego); ?></h2>
        <div id="timer">Tiempo restante: <span id="countdown">60</span> segundos</div>
        <div id="progressBarContainer">
            <div id="progressBar"></div>
        </div>
        <form method="post" id="quizForm" action="mostrar_resultados.php">
            <?php
            foreach ($preguntas_juego as $indice => $pregunta) {
                echo '<p>' . $pregunta['pregunta'] . '</p>';
                foreach ($pregunta['opciones'] as $opcion => $texto) {
                    echo '<input type="radio" name="pregunta' . ($indice + 1) . '" value="' . $opcion . '"> ' . $opcion . ') ' . $texto . '<br>';
                }
            }

            ?>
            <button type="submit" id="submitBtn">Enviar</button>
        </form>
    </div>
    <footer>
        <p>Desarrollado por Cristian Esteban Alvarez Peña</p>
        <div class="social-links">
            <a href="https://www.linkedin.com/in/cristianzeravla/" target="_blank">LinkedIn</a>
            <a href="https://github.com/cristianzeravla"target="_blank">GitHub</a>
        </div>
    </footer>

    <script>
    const timeLimit = 60;
    let remainingTime = timeLimit;

    const countdown = document.getElementById('countdown');
    const progressBar = document.getElementById('progressBar');

    const submitForm = () => {
    document.getElementById('quizForm').submit();
    };

    const interval = setInterval(() => {
        remainingTime--;
        countdown.textContent = remainingTime;

        const percentage = (remainingTime / timeLimit) * 100;
        progressBar.style.width = percentage + '%';

        if (remainingTime <= 0) {
            clearInterval(interval);
            alert('Se agoto el tiempo');
            submitForm();
        }
    }, 1000);

    window.addEventListener('beforeunload', function(e) {
        const form = document.getElementById('quizForm');
        const unansweredQuestions = [...form.querySelectorAll('input[type=radio]:not(:checked)')];

        if (unansweredQuestions.length > 0 && remainingTime > 0) {
            e.returnValue = 'Aún hay preguntas sin responder. ¿Estás seguro de que deseas salir?';
        }
    });
</script>
</body>
</html>