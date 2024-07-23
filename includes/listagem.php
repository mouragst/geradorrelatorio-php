<?php

use App\Entity\Archive;

require 'vendor/autoload.php';

$archives = new Archive($directory, '.docx', 10, $filterFileName);

// Função para excluir arquivo
if (isset($_POST['delete_file'])) {
    if ($archives->deleteFile($_POST['delete_file'])) {
        // Redirecionar para a mesma página para atualizar a lista de arquivos
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        echo "Arquivo não encontrado.";
    }
}

?>
<section>
    <form method="get">

    <div class="row my-2">

        <div class="col">
            <label>Buscar por relatório</label>
            <input type="text" name="filterFileName" class="form-control">
        </div>

        <div class="col d-flex align-items-end">
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </div>

    </div>
    </form>
</section>

<section>
    <table class="table mt-2">
        <thead>
            <tr>
                <th>ID</th>
                <th>Loja</th>
                <th>Arquivo</th>
                <th>Data</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
                echo $archives->renderFiles();
            ?>
        </tbody>
    </table>
    <!-- Links de paginação -->
     <?php
        echo $archives->renderPagination();
     ?>
</body>
</section>
</html>

