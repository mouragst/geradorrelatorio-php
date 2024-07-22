<?php

use App\Entity\Store;
use App\Session\Login;

require 'vendor/autoload.php';

Login::requireLogin();

define('TITLE', 'Editar Loja');

if (isset($_GET['id'])) {
    if (isset($_POST['idLoja'], $_POST['loja'], $_POST['endereco'])) {
        $loja = new Store;
        $loja->id = $_POST['idLoja'];
        $loja->loja = $_POST['loja'];
        $loja->endereco = $_POST['endereco'];
        $loja->editar($_GET['id']);

        header('Location: lojas.php?status=success');
        exit;
    }
} 

if (!isset($_GET['id'])) {
    header('Location: lojas.php?status=error');
    exit;
}

include 'includes/navbar.php';
include 'includes/header.php';
include 'includes/form_loja.php';
include 'includes/footer.php';
