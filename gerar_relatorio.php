<?php

require 'vendor/autoload.php';

use App\Common\Environment;
use App\Session\Login;
use App\Entity\DocGenerator;

Environment::load(__DIR__);
Login::requireLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['loja'])) {
  $directory = __DIR__.'/word_documents/relatorios';
  $templateFile = __DIR__.'/word_documents/templates/template_auditoria.docx';
  $documentGenerator = new DocGenerator($templateFile, $directory);

  $generatedFile = $documentGenerator->generateDocument($_POST);

   // Forçar o download do arquivo gerado
   if (file_exists($generatedFile)) {
      header('Content-Description: File Transfer');
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename="' . basename($generatedFile) . '"');
      header('Expires: 0');
      header('Cache-Control: must-revalidate');
      header('Pragma: public');
      header('Content-Length: ' . filesize($generatedFile));
      readfile($generatedFile);
      exit;
      } else {
      echo "Erro ao baixar o arquivo.";
  }
}

include 'includes/navbar.php';
include 'includes/header.php';
include 'includes/forms.php';
include 'includes/footer.php';
