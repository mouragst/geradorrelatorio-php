<?php

require 'vendor/autoload.php';

use App\Session\Login;
use App\Entity\DocGenerator;

Login::requireLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['loja'])) {
  $directory = 'D:\WorkSpace\ws-php\geradorrelatorio-php\word_documents\relatorios';
  $templateFile = 'word_documents/templates/template_auditoria.docx';
  $reportGenerator = new DocGenerator($templateFile, $directory);

  $reportGenerator->generateDocument($_POST);
}

include 'includes/navbar.php';
include 'includes/header.php';
include 'includes/forms.php';
include 'includes/footer.php';
