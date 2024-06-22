<?php

declare(strict_types=1);

function get_data(string $url): array
{
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

function render_template(string $template, array $data = [])
{
    extract($data);
    require "templates/$template.php";
}
