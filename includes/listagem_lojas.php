<?php

use App\Db\Database;
use App\Entity\Store;
use App\db\Pagination;

$qtd = (new Store)::getQuantidadeLojas();


$pagination = new Pagination($qtd, $_GET['pagina'] ?? 1);

$lojas = Store::getLojas(null, null, $pagination->getLimit());

$results = '';

foreach ($lojas as $loja) {
    $results .= '<tr>
                    <td>'.$loja->id.'</td>
                    <td>'.$loja->loja.'</td>
                    <td>'.$loja->endereco.'</td>
                    <td>
                        <a class="btn btn-danger" href="javascript:void(0);" onclick="confirmDelete('.$loja->id.');">Deletar Loja</a>
                        <a class="btn btn-primary"href="editar.php?id='.$loja->id.'">Editar Loja</a>
                    </td>
                 </tr>';
                    
}

unset($_GET['pagina']);
unset($_GET['status']);
$gets = http_build_query($_GET);


$paginas = $pagination->getPages();
$resultadoPaginas = '';

foreach ($paginas as $key => $pagina) {
    $class = $pagina['current'] ? "btn-primary" : "btn-light";
    $resultadoPaginas .= '<a href=?pagina='.$pagina['page'].'&'.$gets.'>
                            <button class="btn '.$class.'" type="button">'.$pagina['page'].'</button>
                          </a>';
}

?>

<div class="table mt-2">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Loja</th>
                <th>Endereço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?= $results ?>
        </tbody>
    </table>
    <?= $resultadoPaginas ?>
</div>

<script src="../assets/script.js"></script>