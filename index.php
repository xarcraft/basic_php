<?php
//Activar tipos estrictos
declare(strict_types=1); // esta configuracion se debe poner a nivel de archivo NO GLOBAL y en la parte superior del script

const API_URL = "https://whenisthenextmcufilm.com/api";

# para metodos y funciones es recomendable usar el snake_case
function get_data(string $url): array
{
    # podemos optar por una alternativa que nos devuelve el json mucho mas rapido si solo quieres hacer el GET de una API y esta seria usar el file_get_contents
    $result = file_get_contents($url);
    $data = json_decode($result, true);
    return $data;
}

function get_until_message(int $days): string
{
    return match (true) {
        $days === 0 => "Hoy es el gran día",
        $days === 1 => "Mañana es el gran día",
        $days < 7 => "Ya solo falta una semana para el estreno",
        $days < 30 => "este mes es el estreno",
        default => "Ya solo quedan $days días para el estreno"
    };
}

$data = get_data(API_URL);
$untilMessage = get_until_message($data["days_until"]);

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
            <h3><?= $data['title']; ?> <?= $untilMessage; ?></h3>
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