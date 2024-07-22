<?php

use App\Entity\Archive;

require 'vendor/autoload.php';

date_default_timezone_set('America/Sao_Paulo');
$directory = 'D:\WorkSpace\ws-php\geradorrelatorio-php\word_documents\relatorios';

$archives = new Archive($directory, '.docx', 10);

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
</html>

