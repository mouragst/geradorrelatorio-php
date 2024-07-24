<?php

use App\Session\Login;

$loggedUser = Login::getUserLogged();

$user = $loggedUser ? 'Olá, '.$loggedUser['name'].' |<a href="logout.php" class="text-danger fw-bold ms-2">Deslogar</a>' : 
'Visitante <a href="login.php" class="text-light fw-bold ml-2"> Entrar</a>';

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gerador Relatório > Cellular.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body class="bg-dark text-light">
    <!--  Inicio Container -->
    <div class="container">
    <div class="bg-light rounded-bottom text-dark">
          <div class="ms-2 fw-bold">
          <?= $user ?>
          </div>
          <a href="gerar_relatorio.php"><button class="btn btn-success my-2 ms-2">Preencher relatório</button></a>
          <a href="forms_loja.php"><button class="btn btn-success my-2 ms-2">Adicionar loja</button></a>
      </div>

