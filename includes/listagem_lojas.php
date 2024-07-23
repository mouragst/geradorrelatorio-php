<?php

use App\Entity\Store;

$getIdLojas = Store::getLojas();

foreach ($getIdLojas as $id) {
    $idFormatted = str_pad($id->id, 3, '0', STR_PAD_LEFT);
    $resultId .= '<option value="'.$idFormatted.'">'.$idFormatted.'</option>';
}

foreach ($lojas as $loja) {
    $idLoja = str_pad($loja->id, 3, '0', STR_PAD_LEFT);
    $results .= '<tr>
                    <td>'.$idLoja.'</td>
                    <td>'.$loja->loja.'</td>
                    <td>'.$loja->endereco.'</td>
                    <td>
                        <a class="btn btn-danger" href="javascript:void(0);" onclick="confirmDelete('.$loja->id.');">Deletar Loja</a>
                        <a class="btn btn-primary"href="editar.php?id='.$loja->id.'">Editar Loja</a>
                    </td>
                 </tr>';
                    
}

$results = !empty($results) ? $results : '<tr>
                                                    <td colspan="6" class="text-center h5">
                                                        Nenhuma loja encontrada!
                                                    </td>
                                                </tr>';

unset($_GET['pagina']);
unset($_GET['status']);
$gets = http_build_query($_GET);

$paginas = $pagination->getPages();

foreach ($paginas as $key => $pagina) {
    $class = $pagina['current'] ? "btn-primary" : "btn-light";
    $resultadoPaginas .= '<a href=?pagina='.$pagina['page'].'&'.$gets.'>
                            <button class="btn '.$class.'" type="button">'.$pagina['page'].'</button>
                          </a>';
}


?>
<section>
    <form method="get">

    <div class="row my-2">

        <div class="col">
            <label>Buscar por loja</label>
            <input type="text" name="filterLoja" class="form-control">
        </div>

        <div class="col">
            <label>ID Loja</label>
            <select name="filterId" class="form-control">
                <option value="">Selecione a Loja</option>
                <option value="<?= $idLoja; ?>"><?= $resultId; ?></option>
            </select>
        </div>

        <div class="col d-flex align-items-end">
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </div>

    </div>
    </form>
</section>
    
<section>
    <div class="table mt-2">
        <table class="table">
            <thead>
                <?= $mensagem; ?>
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
</section>
<script src="../assets/script.js"></script>