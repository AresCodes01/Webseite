<?php

use Core\Response;

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}

function abort($code = 404)
{
    http_response_code($code);

    require base_path("views/{$code}.php");

    die();
}

function authorize($condition, $status = Response::FORBIDDEN)
{
    if (!$condition) {
        abort($status);
    }

}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    extract($attributes);
    require base_path("views/" . $path);
}

function redirect($path)
{
    header("location: {$path}  ");
    exit();
}
function formState($key = null)
{
    if (session_status() === PHP_SESSION_NONE) session_start();

    $errors = $_SESSION['errors'] ?? [];
    $old = $_SESSION['old'] ?? [];

    unset($_SESSION['errors'], $_SESSION['old']);

    // Wenn ein Schlüssel angegeben wurde
    if ($key) {
        return [
            'old' => htmlspecialchars($old[$key] ?? ''),
            'error' => $errors[$key] ?? null
        ];
    }

    // Wenn kein Schlüssel, alles zurückgeben
    return [
        'old' => array_map('htmlspecialchars', $old),
        'errors' => $errors
    ];
}

