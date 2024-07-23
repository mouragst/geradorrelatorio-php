<?php

use App\Entity\Store;
use App\Db\Pagination;
use App\Session\Login;

require 'vendor/autoload.php';

Login::requireLogin();

if (isset($_GET['status'])) {
    switch ($_GET['status']) {
        case 'success':
            $mensagem = '<div class="alert alert-success">Loja adicionada com sucesso!</div>';
            break;
        case 'error':
            $mensagem = '<div class="alert alert-danger">Ação não executada!</div>';
            break;
        case 'deleted':
            $mensagem = '<div class="alert alert-success">Loja deletada com sucesso!</div>';
            break;
        }
}

//Filtros
$filterId = filter_input(INPUT_GET, 'filterId', FILTER_SANITIZE_NUMBER_INT);
$filterLoja = filter_input(INPUT_GET, 'filterLoja', FILTER_UNSAFE_RAW);

$conditions = [
    !empty($filterLoja) ? 'loja LIKE "%'.str_replace(' ', '%', $filterLoja).'%"' : null,
    !empty($filterId) ? 'id = "'.$filterId.'"' : null
];

$conditions = array_filter($conditions);

$where = implode(' AND ', $conditions);

// Paginação
$qtd = (new Store)::getQuantidadeLojas($where);
$pagination = new Pagination($qtd, $_GET['pagina'] ?? 1);

$lojas = Store::getLojas($where, null, $pagination->getLimit());

include 'includes/navbar.php';
include 'includes/header.php';
include 'includes/listagem_lojas.php';
include 'includes/footer.php';
