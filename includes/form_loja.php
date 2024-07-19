<?php

use App\Entity\Store;

if (isset($_GET['id'])) {
    $lojaId = Store::getLoja($_GET['id']);
}

?>

<form method="post">
    <div class="bg-light text-dark mt-2 p-2 rounded">

    <h3><?= TITLE ?></h3>

        <div class="form-group my-2">
            <label>ID Loja</label>
            <input type="number" class="form-control" name="idLoja" placeholder="Digite o ID da loja" value="<?= $lojaId->id ?>">
            <small class="form-text text-muted">Use somente o digito sem o zero (exemplo: 1 ao invés de 001)</small>
        </div>

        <div class="form-group my-2">
            <label>Loja</label>
            <input type="text" class="form-control"name="loja" placeholder="Digite a loja" value="<?= $lojaId->loja ?>"> 
        </div>

        <div class="form-group my-2">
            <label>Digite o endereço da loja</label>
            <input type="text" class="form-control" name="endereco" placeholder="Digite o endereço da loja" value="<?= $lojaId->endereco ?>">
        </div>

        <button type="submit" class="btn btn-primary mt-2">Enviar</button>
  </div>
</form>