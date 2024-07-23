<?php

require 'vendor/autoload.php';

use App\Common\Environment;
use App\Session\Login;

Environment::load(__DIR__);
Login::requireLogin();

date_default_timezone_set('America/Sao_Paulo');
$directory = getenv('DIRECTORY');

$filterFileName = filter_input(INPUT_GET, 'filterFileName', FILTER_UNSAFE_RAW) ?? '';
$currentPage = filter_input(INPUT_GET, 'pagina', FILTER_VALIDATE_INT) ?? 1;


include 'includes/navbar.php';
include 'includes/header.php';
include 'includes/listagem.php';
include 'includes/footer.php';
