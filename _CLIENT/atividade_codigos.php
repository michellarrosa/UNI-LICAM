<?php
	// header('Content-Type: text/html; charset=UTF-8');
	$sql = 'SELECT * FROM uni__licam_atividades_tabela';
	$result = $this->execQuery($sql)['result'];
	$modReturn=array();
	foreach ($result as $key => $campo) {
		$modReturn.= "<option id='valor' value=$campo[id]> $campo[codramo] - $campo[coddesc]@";	
	}
	echo $modReturn;
?> 