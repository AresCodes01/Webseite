<?php

use Core\App;
use Core\Authenticator;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);
$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];
if (!Validator::email($email)) {
    $errors['email'] = "Please provide a valid email address.";

}

if (!Validator::string($password, 7, 255)) {
    $errors['password'] = "Please provide a password of at least 7 characters.";
}

if (!empty($errors)) {$_SESSION['errors'] = $errors;
    $_SESSION['old'] = ['email' => $email]; // alte Eingabe merken
    return redirect("/register"); // zurück zum Formular
}

$user = $db->query("SELECT * FROM users WHERE email = :email", ["email" => $email])->find();

if ($user) {
    // E-Mail existiert schon → Fehler anzeigen
    $_SESSION['errors'] = ["email" => "This email is already registered."];
    $_SESSION['old'] = ["email" => $email];
    return redirect("/register"); // zurück zum Formular
}

// User anlegen
$db->query("INSERT INTO users (email, password) VALUES (:email, :password)", [
    "email" => $email,
    "password" => password_hash($password, PASSWORD_BCRYPT)
]);

// Neu registrierten User aus DB holen
$user = $db->query("SELECT * FROM users WHERE email = :email", ["email" => $email])->find();

// Login
$auth = new Authenticator();
$auth->login($user);

redirect('/');
