<?php

use App\Session\Login;

require 'vendor/autoload.php';

Login::requireLogin();

include 'includes/navbar.php';
include 'includes/header.php';
include 'includes/listagem_lojas.php';
include 'includes/footer.php';
