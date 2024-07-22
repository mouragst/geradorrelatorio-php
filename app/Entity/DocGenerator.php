<?php

namespace App\Entity;

use PhpOffice\PhpWord\TemplateProcessor;

class DocGenerator {

    private $templateFile;
    private $directory;

    public function __construct($templateFile, $directory){
        $this->templateFile = $templateFile;
        $this->directory = $directory;
    }

    // Formata os itens do post, pois ao gerar o documento sem formatação, a break line no textarea mantem o
    // texto como um só, sem dar break line no documento gerado
    private function formatAllFields($data) {
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $data[$key] = str_replace("\n", '<w:p></w:p>', $value);
            }
        }
        return $data;
    }

    public function generateDocument($data) {
        // Formata todos os campos
        $formattedData = $this->formatAllFields($data);
    
        // Inicializa o Template Processor
        $templateProcessor = new TemplateProcessor($this->templateFile);
    
        // Pega a loja pelo ID para obter o endereço e o nome da loja
        $loja = Store::getLoja($formattedData['loja']);
    
        $timestamp = date("d-m");
        $baseFileName = $loja->loja."_{$timestamp} - Relatório de Auditoria.docx";
    
        // Informações loja
        $templateProcessor->setValue('{{LOJA}}', $loja->loja);
        $templateProcessor->setValue('{{DATA}}', $formattedData['date']);
        $templateProcessor->setValue('{{RESPONSAVEL}}', $formattedData['auditor']);
        $templateProcessor->setValue('{{ENDERECO}}', $loja->endereco);
    
        // Informações Estoque
        $templateProcessor->setValue('{{FALTA_ESTOQUE}}', $formattedData['falta_estoque']);
        $templateProcessor->setValue('{{CRUZAMENTO}}', $formattedData['cruzamento']);
        $templateProcessor->setValue('{{FORA_PRAZO}}', $formattedData['foraprazo']);
    
        // Informações Caixa
        $templateProcessor->setValue('{{CONFERENCIA_MONTANTE}}', $formattedData['conferenciamontante']);
        $templateProcessor->setValue('{{CAIXA_DIVERGENTE}}', $formattedData['caixadivergente']);
        $templateProcessor->setValue('{{VALOR_CAIXA_DIVERGENTE}}', $formattedData['valordivergente']);
    
        // Informações Estrutural
        $templateProcessor->setValue('{{PADRAO_PEX}}', $formattedData['padraopex']);
        $templateProcessor->setValue('{{PROMOCAO_PEX}}', $formattedData['promocaopex']);
        $templateProcessor->setValue('{{CONSERVACAO}}', $formattedData['conservacao']);
        $templateProcessor->setValue('{{PREVENTIVA_PEX}}', $formattedData['preventivapex']);
    
        // Informações T.I
        $templateProcessor->setValue('{{MAQUINA_PAGAMENTO}}', $formattedData['maquinapagamento']);
        $templateProcessor->setValue('{{MANUTENCAO_TI}}', $formattedData['manutencaoti']);
        $templateProcessor->setValue('{{PATRIMONIO_TI}}', $formattedData['patrimonioti']);
    
        // Informações Suprimentos
        $templateProcessor->setValue('{{INSUMOS_NECESSIDADE}}', $formattedData['insumonecessidade']);
        $templateProcessor->setValue('{{INSUMOS_FREQUENCIA}}', $formattedData['insumofrequencia']);
        $templateProcessor->setValue('{{RESPONSAVEL_INSUMOS_LOJA}}', $formattedData['responsavelinsumociente']);
    
        // Observações
        $templateProcessor->setValue('{{FEEDBACK}}', $formattedData['feedback']);
        $templateProcessor->setValue('{{AVALIACAO}}', $formattedData['avaliacao']);
    
        // Plano de Ação e Prazos
        $templateProcessor->setValue('{{DETALHAMENTO_ACOES}}', $formattedData['detalhamentoacoes']);
    
        // Obter um nome de arquivo único
        $fullPathAndName = (new Archive)->getUniqueFileName($this->directory, $baseFileName);
    
        // Salvar o arquivo
        $templateProcessor->saveAs($fullPathAndName);
    }
}