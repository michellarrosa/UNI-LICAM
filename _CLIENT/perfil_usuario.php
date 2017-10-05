<?php
header('Content-Type: application/json; charset=utf-8');
session_start();

$modifica_usuario = $_POST['opcao'];
$usuario = $_POST['dados'];

	$query = "SELECT cpf, nome, email, end_estado, end_cidade, end_cep,end_rua, end_num, end_compl, end_bairro, telefone, rg, empresa,profissao, nascimento FROM uni_contadeusuario_externo WHERE cpf ='".$usuario."'";
	$result = $this->execQuery($query)['result'][0];
	$dtz = new DateTimeZone("America/Sao_Paulo");
	$dataNascimento = new Datetime( str_replace("/", "-", $result['nascimento']), $dtz );
	$result['nascimento'] = $dataNascimento->format("d/m/Y");
		
echo json_encode($result);

?>