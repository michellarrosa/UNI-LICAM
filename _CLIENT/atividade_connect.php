<?php	
	header('Content-Type: text/html; charset=UTF-8');
	$q = $_POST['dados'];
	$sql = "SELECT * FROM com_licam.atividades_tabela WHERE id = '".$q."'";
	$result = $this->execQuery($sql)['result'];
	$row = $result[0]['unidade'];
	$row2 = $result[0]['potencial']; 
	echo $row.",".$row2;	
?>
