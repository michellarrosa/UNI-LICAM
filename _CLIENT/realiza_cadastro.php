<?php 
	header('Content-Type: text/html; charset=UTF-8');
	
	//criar valida_cadastro.php
	$form_cadastro['nome']=explode("=", $_POST['dados'])[1];
	unset( $_POST['dados'], $_POST['componente'], $_POST['modulo'] );
	$dtz = new DateTimeZone("America/Sao_Paulo");
	$nasci = new Datetime( str_replace("/", "-", $_POST['nascimento']), $dtz );
	unset($_POST['nascimento']);
	$senha = array_pop($_POST); //executado duas vezes
	if( $senha == array_pop($_POST) ){
		$form_cadastro = array_merge($form_cadastro, $_POST);
		$verifica_conta = "SELECT * FROM uni_contadeusuario_externo WHERE cpf='".$form_cadastro['cpf']."'";
		$verifica = $this->execQuery($verifica_conta)['numRows'];
		if($verifica > 0){
			$message = "cpf";	// CPF já cadastrado.
		}else{
			$create = $this->createExternalUserCompleto(	$form_cadastro['nome'],
															$form_cadastro['cpf'],
															$senha,
															$form_cadastro['email'],
															$form_cadastro['rg'],
															$nasci->format("Y/m/d"),
															$form_cadastro['empresa'],
															$form_cadastro['profissao'],
															$form_cadastro['end_cep'],
															$form_cadastro['end_estado'],
															$form_cadastro['end_cidade'],
															$form_cadastro['end_bairro'],
															$form_cadastro['end_rua'],
															$form_cadastro['end_num'],
															$form_cadastro['end_compl'],
															$form_cadastro['telefone']
														);
															
			if(strcmp('Erro:01',$create['message']) == 0){					
				$message = "email"; //EMAIL já cadastrado.
			}elseif(strcmp('Erro:02',$create['message']) == 0){
				$message = "cpf"; //CPF já cadastrado.
			}elseif((strcmp('Erro:03',$create['message']) == 0) || (strcmp('Erro:04',$create['message']) == 0) || (strcmp('Erro:05',$create['message']) == 0)){
				$message = "data"; //dados incompatíveis.
			}elseif(strcmp($form_cadastro['cpf'],$create['message']) == 0){				
				$message = "Success"; // Sucesso no cadastro.
			}else{
				$message = "actions"; // Erro ao realizar cadastro. tentar novamente.
			}

		}

		echo $message; //$message é uma flag
		
	}else{
		echo "senhas";
	}
// #############LISTAGEM DE POSSIVEIS ERROS ###############//
//Erro01 -> Cadastro Existente.
//Erro02 -> CPF em uso.
//Success -> Sucesso no cadastro.
//Erro04 -> Erro ao realizar cadastro.
	
//TRUNCATE TABLE com_licam.perfildeusuario, com_licam.empreendimentodata, com_licam.pareceres,com_licam.processo,uni.contadeusuario_externo RESTART IDENTITY

// #############LISTAGEM DE POSSIVEIS ERROS ###############//
?>