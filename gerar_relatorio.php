<?php

use PhpOffice\PhpWord\TemplateProcessor;

require 'vendor/autoload.php';

$templateFile = 'word_documents/templates/template_auditoria.docx';
$templateProcessor = new TemplateProcessor($templateFile);
$directory = __DIR__.'word_documents/relatorios';
$fullPathAndName = " - Relatório de auditoria.docx";


if (isset($_POST['cruzamento'], 
          $_POST['caixadivergente'], 
          $_POST['padraopex'], 
          $_POST['maquinapagamento'], 
          $_POST['insumonecessidade'], 
          $_POST['detalhamentoacoes'])) {
            
            $templateProcessor->setValue('{{FALTAS}}', $_POST['falta']);
            $templateProcessor->setValue('{{CRUZAMENTO}}', $_POST['cruzamento']);
            $templateProcessor->setValue('{{CAIXA_DIVERGENTE}}', $_POST['caixadivergente']);
            $templateProcessor->setValue('{{PADRAO_PEX}}', $_POST['padraopex']);
            $templateProcessor->setValue('{{MAQUINA_PAGAMENTO}}', $_POST['maquinapagamento']);
            $templateProcessor->setValue('{{INSUMOS_NECESSIDADE}}', $_POST['insumonecessidade']);
            $templateProcessor->setValue('{{DETALHAMENTO_ACOES}}', $_POST['detalhamentoacoes']);

            $fullPathAndName = __DIR__.'/word_documents/relatorios/'.$_POST['loja'].' - Relatório de Auditoria.docx';

            $templateProcessor->saveAs($fullPathAndName);
          }



include 'includes/navbar.php';
include 'includes/header.php';
include 'includes/forms.php';
include 'includes/footer.php';
