<?php
	$perfil_usuario = array();
	$perfil_usuario['nome']=explode("=", $_POST['form'])[1];
	unset( $_POST['dados'], $_POST['componente'],$_POST['modulo'] ,$_POST['opcao'],$_POST['form']);
	$perfil_usuario = array_merge($perfil_usuario, $_POST);

	$dtz = new DateTimeZone("America/Sao_Paulo");
	$dataNascimento = new Datetime( str_replace("/", "-", $perfil_usuario['nascimento']), $dtz );
	$perfil_usuario['nascimento'] = $dataNascimento->format("Y/m/d");

	$query = "SELECT * FROM uni_contadeusuario_externo  WHERE cpf = '".$perfil_usuario['cpf']."'";
	$result = $this->execQuery($query)['result'][0];

	function gera_query($perfil_usuario){
		$campos=$valores=array();
		foreach($perfil_usuario as $campo=>$valor){
			if(!empty($valor)){
				$campos[]=$campo;
				if(is_string($valor)){
					$valor = str_replace("'", "`", $valor);
					$valores[] = "'".$valor."'";
				}else{
					$valores[] = $valor;
				}
			}
		}
		
		$update="";
		foreach($campos as $key=>$value){
			$update.=$value.'='.$valores[$key].",";
		}

		// print_r($valores);

		$size = strlen($update);
		$update = substr($update,0, $size-1);
		$query = "UPDATE uni_contadeusuario_externo SET ".$update." WHERE cpf = '".$perfil_usuario['cpf']."'";
		return $query;
	}


	if(empty($perfil_usuario['pswAtual']) && empty($perfil_usuario['senha']) && empty($perfil_usuario['confirma_senha'])){
		$status = gera_query($perfil_usuario);
		$result = $this->execQuery($status);
		if($result['status'] == 1){
			echo "0"; //Perfil atualizado com sucesso!
		}else{
			echo "5";//erro geral
		}

	}elseif(!empty($perfil_usuario['pswAtual']) && !empty($perfil_usuario['senha']) && !empty($perfil_usuario['confirma_senha'])){
		// echo hash(UConfig::$UHash_algo, $perfil_usuario['pswAtual'])." ----- ".$result['password']; //para debug
		if(hash(UConfig::$UHash_algo, $perfil_usuario['pswAtual']) == $result['password']){
			if($perfil_usuario['senha'] != $perfil_usuario['confirma_senha']){
				echo "4";//senha e confirma_senha diferentes
			}else{
				$perfil_usuario['password'] = hash(UConfig::$UHash_algo,$perfil_usuario['senha']);
				unset($perfil_usuario['pswAtual'],$perfil_usuario['confirma_senha'],$perfil_usuario['senha']);

				$status = gera_query($perfil_usuario);
				$result = $this->execQuery($status);
				
				if($result['status'] == 1){
					echo "1"; //senha atualizada com sucesso
				}else{
					echo"5";//erro geral/inserção
				}			 
			}
		}else{
			// echo hash(UConfig::$UHash_algo, $perfil_usuario['pswAtual'])." - ".$result['password']; //dubg
			echo "2"; //senha atual invalida
		}
	}else{
		echo "3"; //algum campo esta vazio
	}


	
?>