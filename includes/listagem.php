<?php

$directory = 'D:\WorkSpace\ws-php\geradorrelatorio-php\word_documents\relatorios';
$extension = '.docx';
$files = [];

$files = glob($directory."/*.*");

if ($files === false) {
    $files = [];
}

// Função para excluir arquivo
if (isset($_POST['delete_file'])) {
    $fileToDelete = $directory . '/' . basename($_POST['delete_file']);
    if (file_exists($fileToDelete)) {
        unlink($fileToDelete);
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
            if (count($files) > 0) {
                foreach ($files as $index => $file) {
                    // Obter o nome do arquivo
                    $fileName = basename($file);
                    // Obter a data de modificação do arquivo
                    $fileDate = date("d/m/Y - H:i", filemtime($file));
                    // Extrair o nome da loja
                    $loja = explode('-', $fileName)[0];

                    echo '<tr>';
                    echo '<td>' . ($index + 1) . '</td>'; // ID
                    echo '<td>' . htmlspecialchars($loja) . '</td>'; // Nome da loja
                    echo '<td>' . htmlspecialchars($fileName) . '</td>'; // Nome do arquivo
                    echo '<td>' . htmlspecialchars($fileDate) . '</td>'; // Data de modificação do arquivo
                    echo '<td>';
                    echo '<a href="baixar.php?file=' . urlencode($fileName) . '" class="btn btn-primary">Baixar</a>';
                    echo ' <form action="" method="post" style="display:inline-block;">';
                    echo ' <input type="hidden" name="delete_file" value="' . htmlspecialchars($fileName) . '">';
                    echo ' <button type="submit" class="btn btn-danger" onclick="return confirm(\'Tem certeza que deseja excluir este arquivo?\')">Excluir</button>';
                    echo ' </form>';
                    echo '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="5">Nenhum arquivo encontrado.</td></tr>';
            }
            ?>
        </tbody>
    </table>

</body>
</html>

<!-- <div class="table mt-2">
    <table class="table">
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
            <tr>
                <td></td>
            </tr>
        </tbody>
    </table>
</div> -->