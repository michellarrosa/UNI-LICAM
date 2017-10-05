<?php
header('Content-type: application/json; charset=utf-8');
session_start();

$formulario= $_POST['dados'];
$tabela_nome = trim($_POST['tabela']);

    if(trim($tabela_nome) == "equipamentos_utilizacao"){
        $tabela_nome="equipamentos_tabela";
    }
    if(trim($tabela_nome) == "producao_processo"){
        $tabela_nome="producao_tabela";
    }
    if(trim($tabela_nome) == "prestacao_servico"){
        $tabela_nome="prestacao_tabela";
    }


$query = "SELECT $tabela_nome FROM uni__licam_empreendimentodata WHERE id='".$_SESSION['licenciamentos'][$formulario]."'";

$result = $this->execQuery($query)['result'][0];
$hold_array = array();
$temp = array();

//verifico o numero de linha existente para analisar quantas linha criar na tabela
$temp[] = substr_count($result[$tabela_nome],'\n');

//Após isto retiro todos os \n
$result[$tabela_nome] = str_replace('\n', '\t',$result[$tabela_nome]);

// Quebro minha string no \t e retiro o ultimo elemento que fica vazio pois o \n é substituido por \t
// Motivo Substituição:    a\tb\tc\nd\te\tf\n Retirando os \n fica a\tb\tcd\te\tf\ --> Fica cd o que não deve ocorrer
// logo susbstitui-se por \t:  a\tb\tc\nd\te\tf\n Retirando os \n fica a\tb\tc\td\te\tf\t

$hold_array = explode('\t',$result[$tabela_nome]);
array_pop($hold_array);
foreach ($hold_array as $key => $value) {
    $temp[] = $value;
}
//##################### MOSTRA ###########################
echo json_encode($temp)
?> 