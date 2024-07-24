<?php

require 'vendor/autoload.php';

use App\Session\Login;

Login::requireLogin();

date_default_timezone_set('America/Sao_Paulo');
$directory = __DIR__.'/word_documents/relatorios';

$filterFileName = filter_input(INPUT_GET, 'filterFileName', FILTER_UNSAFE_RAW) ?? '';
$currentPage = filter_input(INPUT_GET, 'pagina', FILTER_VALIDATE_INT) ?? 1;

include 'includes/navbar.php';
include 'includes/header.php';
include 'includes/listagem.php';
include 'includes/footer.php';
