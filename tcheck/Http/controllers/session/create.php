<?php

//view("session/create.view.php", [
//    "errors" => $_SESSION["errors"] ?? []
//]);
use Core\Session;

view('session/create.view.php', [
    'errors' => Session::get('errors')
]);

