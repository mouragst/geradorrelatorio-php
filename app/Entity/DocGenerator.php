<?php

namespace App\Entity;

use DateTime;
use IntlDateFormatter;
use PhpOffice\PhpWord\TemplateProcessor;

class DocGenerator {

    private $templateFile;
    private $directory;

    public function __construct($templateFile, $directory){
        $this->templateFile = $templateFile;
        $this->directory = $directory;
    }

    private function formatDateInPortuguese($dateString) {
        // Configurações de localidade e timezone
        $locale = 'pt_BR';
        $timezone = 'America/Sao_Paulo';
        $date = DateTime::createFromFormat('Y-m-d', $dateString);

        if ($date) {
            $formatter = new IntlDateFormatter(
                $locale,
                IntlDateFormatter::LONG, // Formato longo: 23 de julho de 2024
                IntlDateFormatter::NONE, // Sem hora
                $timezone
            );

            $formatter->setPattern('dd \'de\' MMMM \'de\' yyyy');
            return $formatter->format($date);
        }

        // Retorna uma string vazia se a data for inválida
        return '';
    }

    public function displayFormattedDate($dateString) {
        return $this->formatDateInPortuguese($dateString);
    }


    // Formata os itens do post, pois ao gerar o documento sem formatação, a break line no textarea mantem o
    // texto como um só, sem dar break line no documento gerado
    private function formatAllFields($data) {
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                // Substituir todas as quebras de linha por <w:p></w:p>
                $value = preg_replace("/\r\n|\r|\n/", "<w:p></w:p>", $value);
    
                // Remover espaços extras ao redor das tags <w:p></w:p>
                $value = preg_replace("/<w:p><w:p>[\s]*<\/w:p><w:p>/", "<w:p></w:p><w:p></w:p>", $value);
                $value = preg_replace("/<\/w:p><w:p>[\s]+/", "</w:p><w:p>", $value);
    
                $data[$key] = $value;
            }
        }
        return $data;
    }

    public function generateDocument($data) {
        // Formata a data
        $formattedDate = $this->displayFormattedDate($_POST['date']);

        // Formata todos os campos
        $formattedData = $this->formatAllFields($data);
    
        // Inicializa o Template Processor
        $templateProcessor = new TemplateProcessor($this->templateFile);
    
        // Pega a loja pelo ID para obter o endereço e o nome da loja
        $loja = Store::getLoja($formattedData['loja']);
        $idLoja = str_pad($loja->id, 3, '0', STR_PAD_LEFT);
    
        // Ajusta o nome do arquivo
        $timestamp = date("d-m");
        $baseFileName = $idLoja.'_'.$loja->loja."_{$timestamp} - Relatório de Auditoria.docx";
    
        // Informações loja
        $templateProcessor->setValue('{{LOJA}}', $idLoja.' - '.$loja->loja);
        $templateProcessor->setValue('{{DATA}}', $formattedDate);
        $templateProcessor->setValue('{{RESPONSAVEL}}', $formattedData['auditor']);
        $templateProcessor->setValue('{{ENDERECO}}', $loja->endereco);
    
        // Informações Estoque
        $templateProcessor->setValue('{{FALTA}}', $formattedData['falta_estoque']);
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
    
        // Verifica se o nome de arquivo é único
        $fullPathAndName = (new Archive)->getUniqueFileName($this->directory, $baseFileName);
    
        // Salva o arquivo
        $templateProcessor->saveAs($fullPathAndName);

        return $fullPathAndName;
    }
}