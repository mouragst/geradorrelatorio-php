<?php

require __DIR__.'/vendor/autoload.php';
use App\Entity\User;
use App\Session\Login;

Login::logout();

$alertLogin = '';

if (isset($_POST['acao'])) {
    $user = User::getUserByEmail($_POST['email']);

    if (!$user instanceof User || !password_verify($_POST['password'], $user->password)) {
        $alertLogin = "E-mail ou senha inválidos";
    }

    Login::login($user);
}

include "includes/header.php";
include "includes/formulario-login.php";
include "includes/footer.php";