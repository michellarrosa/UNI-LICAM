<?php
	header('Content-Type: text/html; charset=UTF-8');
	session_start();
	$contato_form['usuario_nome']=explode("=", $_POST['dados'])[1];
	unset( $_POST['dados'], $_POST['componente'], $_POST['modulo']);
	$contato_form = array_merge($contato_form, $_POST);	
	if(isset($_SESSION['uni_ext_cpf'])){
		$contato_form['usuario_status'] = $_SESSION['uni_ext_cpf'];
	}else{
		$contato_form['usuario_status'] =" Usuário Não Cadastrado";
	}

	foreach($contato_form as $campo=>$valor){
		$campos[]=$campo;
		if(is_string($valor)){
			$valor = str_replace("'", "`", $valor);
			$valores[] = "'".$valor."'";
		}else{
			$valores[] = $valor;
		}
	}
	
	$envia_mensagem = "INSERT INTO uni__licam_mensagens(" . implode(',', $campos) . ") VALUES (" . implode(',', $valores) . ")";
	$result = $this->execQuery($envia_mensagem)['status'];
	
	if($result == 1){
		echo 'Success'; //tudo correto
	}else{
		echo 'Warning'; //provavelmente um erro interno/query.Não há com outros dados!!
	} 
?>