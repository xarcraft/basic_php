<!-- llamadas a api desde php -->
<?php
const API_URL = "https://whenisthenextmcufilm.com/api";
# Inicializar una nueva sesion de cURL; ch= cURL handle
$ch = curl_init(API_URL);
// quitar verificador ssl para prevenir errores en ejecucion
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Indicar que queremos recibir el resultado de la peticion y no mostrarlo en pantalla
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
/* ejecutar la peticion y guardar el resultado */
$result = curl_exec($ch);
/*
    podemos optar por una alternativa que nos devuelve el json mucho mas rapido si solo quieres hacer el GET de una API y esta seria usar el file_get_contents
    $result=file_get_contents(API_URL);
*/
/* comprobar y descartar errores en la conexion */
if (curl_errno($ch)) {
    $error_msg = curl_error($ch);
    echo "Error al conectarse a la API $error_msg <br>";
} else {
    /* decodificar la informacion que devuelve la consulta */
    $data = json_decode($result, true);
    // cerrar la conexion
    curl_close($ch);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La proxima pelicula de marvel</title>
    <!-- Centered viewport -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css" />
</head>

<body>
    <main>
        <section>
            <img src="<?= $data['poster_url']; ?>" alt="Poster de <?= $data['title']; ?>" width="300" style="border-radius: 16px;">
        </section>
        <hgroup>
            <h3><?= $data['title']; ?> se estrena en <?= $data['days_until']; ?> días</h3>
            <p>Fecha de estreno: <?= $data['release_date']; ?></p>
            <p>La siguiente es: <?= $data['following_production']['title']; ?></p>
        </hgroup>
    </main>
</body>

</html>


<style>
    :root {
        color-scheme: ligth dark;
    }

    body {
        display: grid;
        place-content: center;
    }

    section {
        display: flex;
        justify-content: center;
        text-align: center;
    }

    hgroup {
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
    }

    img {
        margin: 0 auto;

    }
</style>
