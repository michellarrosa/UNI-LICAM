<?php
header('Content-Type: application/json; charset=utf-8');
session_start();
$query = "SELECT id FROM uni__licam_empreendimentodata WHERE responsavel_cpf='".$_SESSION['uni_ext_cpf']."' ORDER BY id";
	$res = $this->execQuery($query)['result'];

	unset($_SESSION['licenciamentos']);
		foreach($res as $value){
			$_SESSION['licenciamentos'][] = $value['id'];					
		}
		
$form_togo = $_POST['dados'];

$query = "SELECT * FROM uni__licam_empreendimentodata WHERE id =".$_SESSION['licenciamentos'][$form_togo];
$result = $this->execQuery($query)['result'][0];

$value= $result['emp_coord'];
$value = str_replace('(',"",$value);
$value = str_replace(')',"",$value);
$result['emp_coord'] = $value;


if(isset($result['atividade_dataini'])){
	$atividade_dataini = new Datetime( $result['atividade_dataini']); // o DateTimeZone eh o padrao do PGSQL
	$result['atividade_dataini'] = $atividade_dataini->format("d/m/Y");
}

if(($result['tipolicenca'] == "LU") || ($result['tipolicenca'] == "RLU" )){
   $result['num_licenca'] = "2";
}elseif($result['tipolicenca'] == "LF"){
   $result['num_licenca'] = "1";
}elseif($result['tipolicenca'] == "NL"){
   $result['num_licenca'] = "0";
}else{
  $result['num_licenca'] = "3";
}

foreach($result as $key =>$value){
	if(!isset($result[$key])){
		unset($result[$key]);
	}else{
		if(($key = array_search('Total', $result)) == 'Total') {
			$result[$key] = "Total";
		}
		if(($key = array_search('Parcial', $result)) == 'Parcial') {
			$result[$key] = "Parcial";
		}
	}
}
	
	
// print_r($result); //para debug

echo json_encode($result);
?>
