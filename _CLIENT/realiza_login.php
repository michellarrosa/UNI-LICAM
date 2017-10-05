<?php
	header('Content-Type: text/html; charset=UTF-8');
	//refazer na classe
	$login = $this->loginExternalUser($_POST['email'],$_POST['senha']);
	if($login['status'] == FALSE && $login['message']=='Erro00'){
		echo "Login ou senha incorretos.";
		return;
		
	}elseif($login['status'] == FALSE && $login['message']=='email'){
		echo "Email não cadastrado.";
		return;
	}else{
		session_start();
		$sql = "SELECT id, nome, cpf FROM uni_contadeusuario_externo WHERE email='".$_POST['email']."'";
		$result = $this -> execQuery($sql);
		if($result['status']){
			if($result['numRows']>0){
				$result = $result['result'][0];
				$_SESSION['uni_ext_id'] = $result['id'];
				$_SESSION['uni_ext_username'] = $result['nome'];
				$_SESSION['uni_ext_login'] = $login;
				$_SESSION['uni_ext_id_form'] ="";
				$_SESSION['uni_ext_form_op'] ="";
				$_SESSION['uni_ext_cpf'] = $result['cpf'];
				$query = "SELECT id FROM uni__licam_empreendimentodata WHERE responsavel_cpf='".$result['cpf']."' ORDER BY id";
				$res = $this->execQuery($query)['result'];

				unset($_SESSION['licenciamentos']);
					foreach($res as $value){
						$_SESSION['licenciamentos'][] = $value['id'];					
					}
				// setcookie('uni_ext_cpf', $result['cpf'] , 0, "/", $_SERVER['SERVER_NAME']);
				echo $login['message'];
			}else{
				echo "Erro interno. Informe o seguinte código de erro: 101 ";
			}
		}else{
			echo "Erro interno. Informe o seguinte código de erro: 102 ";
		}
	}

?>
