<?php

use App\Entity\Store;

require "vendor/autoload.php";

$lojas = Store::getLojas();
$nomeLojas = '';
$enderecoLojas = '';

foreach ($lojas as $loja) {
    $nomeLojas .= '<option value="'.$loja->id.'">'.$loja->loja.'</option>';
}

?>

<form method="post">
    <div class="bg-light text-dark p-3 rounded mt-2">
        <h1>Insira as informações</h1>

    <div class="tab">
            <button type="button" class="tablinks btn btn-info" onclick="openTab(event, 'InfoAuditor')">Informações Gerais</button>
            <button type="button" class="tablinks btn btn-info" onclick="openTab(event, 'Estoque')">Estoque</button>
            <button type="button" class="tablinks btn btn-info" onclick="openTab(event, 'Caixa')">Caixa</button>
            <button type="button" class="tablinks btn btn-info" onclick="openTab(event, 'Estrutural')">Estrutural</button>
            <button type="button" class="tablinks btn btn-info" onclick="openTab(event, 'ParqueDeMaquina')">Parque de Máquina</button>
            <button type="button" class="tablinks btn btn-info" onclick="openTab(event, 'Insumo')">Insumo</button>
            <button type="button" class="tablinks btn btn-info" onclick="openTab(event, 'Observacoes')">Observações</button>
            <button type="button" class="tablinks btn btn-info" onclick="openTab(event, 'Conclusao')">Conclusão</button>
        </div>

        <div id="InfoAuditor" class="tabcontent form-group">
            <h3>Informações da Auditoria</h3>
            <label>Loja: </label>
            <select class="form-control mb-2" name="loja" ><?= $nomeLojas ?></select>
            <label>Auditor Responsável: </label>
            <select class="form-control mb-2" name="auditor"><option value="Robson Pinheiro">Robson Pinheiro</option></select>
            <label>Data da auditoria: </label>
            <input type="date" class="form-control mb-2" name="date">
        </div>

        <div id="Estoque" class="tabcontent form-group">
            <h3>Estoque</h3>
            <label>a. Quantidade física de produtos em estoque.</label>
            <textarea type="text" name="falta" class="form-control my-2" rows="4"></textarea>
            <label>b. Conferência de registros no sistema versus contagem física.</label>
            <textarea type="text" name="cruzamento" class="form-control my-2" rows="4"></textarea>
            <label>c. Identificação de produtos obsoletos ou vencidos.</label>
            <textarea type="text" name="foraprazo" class="form-control my-2" rows="4"></textarea>
        </div>

        <div id="Caixa" class="tabcontent form-group">
            <h3>Caixa</h3>
            <label>a. Conferência do montante inicial e final no caixa e atendimento pendentes.</label>
            <textarea type="text" name="conferenciamontante" class="form-control my-2" rows="4"></textarea>
            <label>b. Comparação dos registros financeiros com os valores físicos.</label>
            <textarea type="text" name="caixadivergente" class="form-control my-2" rows="4"></textarea>
            <label>c. Verificação de irregularidades ou discrepâncias.</label>
            <textarea type="text" name="valordivergente" class="form-control my-2" rows="4"></textarea>
        </div>

        <div id="Estrutural" class="tabcontent form-group">
            <h3>Estrutural</h3>
            <label>a. Layout da loja em conformidade com o padrão visual da Claro.</label>
            <textarea type="text" name="padraopex" class="form-control my-2" rows="4"></textarea>
            <label>b. Disposição adequada de produtos e materiais promocionais.</label>
            <textarea type="text" name="promocaopex" class="form-control my-2" rows="4"></textarea>
            <label>c. Estado de conservação de mobiliário e equipamentos.</label>
            <textarea type="text" name="conservacao" class="form-control my-2" rows="4"></textarea>
            <label>d. Verificação de necessidade de manutenção preventiva.</label>
            <textarea type="text" name="preventivapex" class="form-control my-2" rows="4"></textarea>
        </div>

        <div id="ParqueDeMaquina" class="tabcontent form-group">
            <h3>Parque de Maquinas</h3>
            <label>a. Funcionamento adequado de terminais de pagamento.</label>
            <textarea type="text" name="maquinapagamento" class="form-control my-2" rows="4"></textarea>
            <label>b. Verificação de necessidade de manutenção preventiva.</label>
            <textarea type="text" name="manutencaoti" class="form-control my-2" rows="4"></textarea>
            <label>c. Verificação de irregularidades dos patrimônios.</label>
            <textarea type="text" name="patrimonioti" class="form-control my-2" rows="4"></textarea>
        </div>

        <div id="Insumo" class="tabcontent form-group">
            <h3>Insumos em Loja</h3>
            <label>a. Insumos em loja atende a necessidade.</label>
            <textarea type="text" name="insumonecessidade" class="form-control my-2" rows="4"></textarea>
            <label>b. Regularidade no abastecimento de materiais necessários.</label>
            <textarea type="text" name="insumofrequencia" class="form-control my-2" rows="4"></textarea>
            <label>c. Garantia de que o processo de abastecimento esteja compreendido pelo responsável.</label>
            <textarea type="text" name="responsavelinsumociente" class="form-control my-2" rows="4"></textarea>
        </div>

        <div id="Observacoes" class="tabcontent form-group">
            <h3>Observações</h3>
            <label>a. Insumos em loja atende a necessidade.</label>
            <textarea type="text" name="insumonecessidade" class="form-control my-2" rows="4"></textarea>
            <label>b. Regularidade no abastecimento de materiais necessários.</label>
            <textarea type="text" name="insumofrequencia" class="form-control my-2" rows="4"></textarea>
        </div>

        <div id="Conclusao" class="tabcontent form-group">
            <h3>Plano de ação e Prazos</h3>
            <label>a. Detalhamento de ações corretivas a serem tomadas, responsáveis pela correção e prazos.</label>
            <textarea type="text" name="detalhamentoacoes" class="form-control my-2" rows="9"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Gerar relatório</button>
    </div>
</form>
<script src="/assets/script.js"></script>