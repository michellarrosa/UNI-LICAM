<?php 

	foreach($_POST as $key=>$value ){
		$value = str_replace("'", "´", $value);
		$$key = $value;
	}

  if(isset($cpf) && isset($nome) && isset($end_estado) && isset($end_cidade) && isset($end_cep) && isset($end_rua) && isset($end_num) && isset($end_compl) && isset($end_bairro) && isset($email) && isset($telefone) && isset($rg) && isset($empresa) && isset($profissao) && isset($nascimento)){
		if(!empty($cpf) && !empty($nome) && !empty($end_estado) && !empty($end_cidade) && !empty($end_cep) && !empty($end_rua) && !empty($end_num) && !empty($end_bairro) && !empty($email) && !empty($telefone) && !empty($rg) && !empty($empresa) && !empty($profissao) && !empty($nascimento)){
			$verify_format = $this->verifyFormat("DATE_BRAZIL_BIRTHDAY", $nascimento);
			if($verify_format['status']){
				$nascimento = implode("/",array_reverse(explode("/",$nascimento)));
				$verify_format = $this->verifyFormat("CPF", $cpf);
				if($verify_format['status']){
					$verify_format = $this->verifyFormat("PHONE", $telefone);
					if($verify_format['status']){
						$verify_format = $this->verifyFormat("EMAIL", $email);
						if($verify_format['status']){
					
				
								$verifica_sql = "SELECT * FROM uni__licam_perfildeusuario WHERE cpf='".$cpf."'";
								$verifica = $this->execQuery($verifica_sql)['numRows'];
								if($verifica == 0){
									$result = $this->createExternalUser($nome,$cpf,$senha,$email);
									if($result['status']){
										$sql = "INSERT INTO uni__licam_perfildeusuario(cpf, nome, end_estado, end_cidade, end_cep, end_rua, end_num, end_compl, end_bairro, email, telefone, rg, empresa, profissao, nascimento) VALUES ('$cpf','$nome','$end_estado','$end_cidade','$end_cep','$end_rua','$end_num','$end_compl','$end_bairro','$email','$telefone','$rg','$empresa','$profissao','$nascimento');";
										$result = $this->execQuery($sql)['status'];
										if($result == 1){
											$message = "ok";
										}else{
											// $message = "ERRO!";
											$message = $sql;
										}
									}else{$message=$result['message'];}
								}else{$message="Perfil Existente!";}
						}else{$message="Dados cadastrais fora de formato! <br>".$verify_format['message'];}
					}else{$message="Dados cadastrais fora de formato! <br>".$verify_format['message'];}
				}else{$message="Dados cadastrais fora de formato! <br>".$verify_format['message'];}
			}else{$message="Dados cadastrais fora de formato! <br>".$verify_format['message'];}
		}else{$message="Dados cadastrais incompletos!";}
	}else{$message="Dados cadastrais incompletos!";}
	
//Erro01 -> Cadastro Existente.
//Erro02 -> CPF em uso.
//Erro03 -> sucesso no cadastro.
//Erro04 -> Erro ao realizar cadastro.
	// $message = "erro03";
echo $message;

?>