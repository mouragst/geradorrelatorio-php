<?php

require "vendor/autoload.php";

use App\Common\Environment;
use App\Session\Login;

Environment::load(__DIR__);
Login::requireLogin();

// Verifica se o parâmetro 'file' está presente na URL
if (isset($_GET['file'])) {
    // Sanitiza o nome do arquivo para evitar problemas de segurança
    $fileName = basename($_GET['file']);
    
    // Define o diretório onde os arquivos estão localizados
    $directory = __DIR__.'/word_documents/relatorios';
    
    // Construa o caminho completo para o arquivo
    $filePath = $directory . '/' . $fileName;
    
    // Verifica se o arquivo existe
    if (file_exists($filePath)) {
        // Força o download do arquivo
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        
        // Limpa o buffer de saída
        flush();
        
        // Lê o arquivo e envia para o navegador
        readfile($filePath);
        exit;
    } else {
        // Se o arquivo não existir, exibe uma mensagem de erro
        echo 'Arquivo não encontrado.';
    }
} else {
    // Se o parâmetro 'file' não estiver presente, exibe uma mensagem de erro
    echo 'Nenhum arquivo especificado.';
}

