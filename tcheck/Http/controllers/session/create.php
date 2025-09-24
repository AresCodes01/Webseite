<?php

view("session/create.view.php", [
    "errors" => $_SESSION["errors"] ?? []
]);


//view('session/create.view.php', [
//    'errors' => Session::get('errors')
//]);

