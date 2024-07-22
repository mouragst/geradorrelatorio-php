<?php

require 'vendor/autoload.php';

use App\Entity\Store;
use App\Session\Login;

Login::requireLogin();

if (isset($_GET['id'])) {
    (new Store)->deletar($_GET['id']);

    header('Location: lojas.php?status=success');
    exit;
}

header ('Location: index.php?status=error');
exit;