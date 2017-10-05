<?php
	header('Content-Type: text/html; charset=UTF-8');
	session_start();	
	$licform['responsavel_cpf'] = $_SESSION['uni_ext_cpf'];
	$licform['status'] ="editável";
	$licform['empreendedor_nome']=explode("=", $_POST['dados'])[1];
	unset( $_POST['dados'], $_POST['componente'], $_POST['modulo'] );
	// array_shift($_POST);	array_shift($_POST);	array_shift($_POST);
	$licform = array_merge($licform, $_POST);
	
	if(array_key_exists('atividade_dataini',$licform) && !empty($licform['atividade_dataini'])){
		$dtz = new DateTimeZone("America/Sao_Paulo");
		$atividade_dataini = new Datetime( str_replace("/", "-", $licform['atividade_dataini']), $dtz );
		$licform['atividade_dataini'] = $atividade_dataini->format("Y/m/d");
	}
	
	// echo "<pre>";
	// print_r($licform);
	// echo "</pre>";
######################################################################1o QUADRANTE OBRIGATÓRIO
$quadrante01 = array("empreendedor_nome"=>"Nome do empreendedor","empreendedor_cnpjcpf"=>"CNPJ ou CPF do empreendedor","empreendedor_end_rua"=>"Rua do empreendedor","empreendedor_end_numero"=>"Numero do Empreendedor","empreendedor_end_bairro"=>"Bairro do Empreendedor","empreendedor_end_cep"=>"CEP do Empreendedor","empreendedor_end_cidade"=>"Cidade do Empreendedor","empreendedor_end_estado"=>"Estado do empreendedor","empreendedor_email"=>"Email do empreendedor", "empreendedor_telefone"=>"Telefone do empreendedor");
$quadrante02 = array("emp_razaosocial"=>"Razão Social","emp_fantasia"=>"Nome Fantasia","emp_cnpjcpf"=>"CNPJ/CPF do Empreendimento","emp_end_rua"=>"Rua do empreendimento","emp_end_numero"=>"Numero do empreendimento","emp_end_bairro"=>"Bairro do empreendimento","emp_end_cep"=>"CEP do empreendimento","emp_end_cidade"=>"Cidade do empreendimento","emp_end_estado"=>"Estado do empreendimento");
$quadrante03 = array("emp_coord" => "Coordenada do empreendimento","emp_status_coord" => "Status da coordenada do empreendimento");

$quadrante04 = array("atividade_cod"=>"Código da Atividade", "atividade_tamanho"=>"Tamanho da atividade", "atividade_auto_unid_medida"=>"Unidade de medida", "atividade_auto_potencialpoluidor"=>"Potencial poluidor", "atividade_auto_porte"=>"Porte da atividade", "tipoLicenca"=>"Tipo de licença", "resolucao"=>"Resolução");

$quadrante_checkbox = array("atividade_seg"=>FALSE,"atividade_ter"=>FALSE,"atividade_qua"=>FALSE,"atividade_qui"=>FALSE,"atividade_sex"=>FALSE,"atividade_sab"=>FALSE,"atividade_dom"=>FALSE,"agua_redepublica"=>FALSE,"agua_rioouarroio"=>FALSE,"agua_poco"=>FALSE,"agua_outro"=>FALSE,"agua_outro_especificar"=>"","sanitarios_tipo_sistema_publico"=>FALSE,
"sanitarios_tipo_nao_possui"=>FALSE,"sanitarios_tipo_sistema_proprio"=>FALSE,"liquidos_geracao_processo_prod"=>FALSE,"liquidos_geracao_refrigeracao"=>FALSE,
"liquidos_geracao_lavagem"=>FALSE,"liquidos_geracao_lavag_veiculos"=>FALSE,"liquidos_geracao_outros"=>FALSE);



	if(isset($licform['equipamentos_utilizacao'])){
		if($licform['equipamentos_utilizacao']=="TRUE"){
			$licform['equipamentos_tabela']="";
			foreach($licform['equipNome'] AS $key=>$value){
				if($value != ""){// se o checkbox for true e os text estiverem vazios equipamentos_tabela continuará NULL=""
					$licform['equipamentos_tabela'] .= $value.'\\\t'.$licform['equipDescricao'][$key].'\\\t'.$licform['equipQuantidade'][$key].'\\\n';	
				}
			}
			unset($licform['equipNome']);
			unset($licform['equipDescricao']);
			unset($licform['equipQuantidade']);
		}
	}
	
	if(isset($licform['producao_processo'])){ //  Há processo produtivo no empreendimento? 
		if($licform['producao_processo']=="TRUE"){
			$licform['producao_tabela']="";
			foreach($licform['prodNome'] AS $key=>$value){
				if($value != ""){// se o checkbox for true e os text estiverem vazios producao_tabela continuará NULL=""
					$licform['producao_tabela'] .= $value.'\\\t'.$licform['prodQuantidade'][$key].'\\\t'.$licform['prodAcondicionamento'][$key].'\\\n';		
				}
			}
			unset($licform['prodNome']);
			unset($licform['prodQuantidade']);
			unset($licform['prodAcondicionamento']);
		}
	}
	
	if(isset($licform['prestacao_servico'])){ //  Há processo produtivo no empreendimento? 
		if($licform['prestacao_servico']=="TRUE"){
			$licform['prestacao_tabela']="";
			foreach($licform['servico'] AS $key=>$value){
				if($value != ""){// se o checkbox for true e os text estiverem vazios prestacao_tabela continuará NULL=""
					$licform['prestacao_tabela'] .= $value.'\\\t'.$licform['prestQuantidade'][$key].'\\\t'.$licform['prestAcondicionamento'][$key].'\\\n';		
				}
			}
			unset($licform['servico']);
			unset($licform['prestQuantidade']);
			unset($licform['prestAcondicionamento']);
		}
	}



########################################## QUADRANTE NÃO OBRIGATÓRIO O PREENCHIMENTO NO EXATO MOMENTO DO ENVIO ####################################
$quadrantenao_obrigatorio = array(

"vegetacao_areautil"=>array(
	"vegetacao_intervencao" => "Intervenção na vegetação",
	"item"=>"<strong><br>13. Vegetação: </strong>"),
"solidos_geracao"=>array(
	"solidos_geracao_esp"=>"Descrição(tipo, acondicionamento, destinação final, entre outros)",
	"item"=>"<strong><br>12. Resíduos sólidos: </strong>"	
),
"atm_geracao"=>array( 
	"atm_geracao_esp"=>"Descrição das fontes geradoras e dos mecanismos de controle",
	"item"=>"<strong><br>11. Emissões sonoras e atmosféricas: </strong>"	
),

"sanitarios_geracao"=>array(
	"sanitarios_reaproveita"=>"Reaproveitamento dos efluentes sanitários",
	"sanitarios_tipo_sistema_publico"=>array("sanitarios_disposicao_final"=>"Disposição final dos efluentes sanitários"),
	"sanitarios_tipo_sistema_proprio"=>array("sanitarios_sistema_proprio_esp"=>"Especificação do tipo de sistema próprio"),
	"item"=>"<strong><BR>9. Efluentes líquidos sanitários: </strong>"
),

"liquidos_geracao"=>array(
	"liquidos_reaproveita"=>"Reaproveitamento dos efluentes industriais",
	"liquidos_disposicao"=>"Disposição final dos efluentes líquidos industriais",
	"liquidos_geracao_outros"=>array("liquidos_geracao_outros_esp"=>"Especificação das etapas de geração dos efluentes líquidos industriais"),
	"liquidos_gerecao_esp"=>"Especificação do tipo de tratamento dos efluentes líquidos industriais",
	"item"=>"<strong><BR>10. Efluentes líquidos industriais: </strong>"
),

"agua_consumo"=>array(
	"agua_outro"=>array("agua_outro_especificar"=>"Descrição do tipo de abastecimento"),
	"item"=>"<strong><BR>8. Informações sobre o consumo de água: </strong>"
),

"prestacao_servico"=>array(
	"prestacao_descricao"=>"Descrição das etapas do processo de prestação dos serviços",
	"prestacao_tabela"=>"Forma de prestação, quantidade prestação/mês, serviço prestado",
	"item"=>"<strong><br>7. Relação de serviços do empreendimento:</strong>"
),

"producao_processo"=>array(
	"producao_descricao"=>"Descrição das etapas do processo produtivo industrial",
	"producao_tabela"=>"Forma de acondicionamento, quantidade produzida/mês, produto final",
	"item"=>"<strong><br>7. Relação de produção do empreendimento: </strong>"
),

"equipamentos_utilizacao"=>array(
	"equipamentos_tabela"=>"Equipamentos, descricao e quantidade",
	"item"=>"<strong><br>6. Relação dos equipamentos utilizados no empreendimento: </strong>"
),

"atividade_iniciada"=>array(
	"atividade_horaencerramento"=>"Horário de fim do expediênte",
	"atividade_horaintervalofim"=>"Fim do intervalo do expediênte",
	"atividade_horaintervalo"=>"Início do intervalo do expediênte",
	"atividade_horainicio"=>"Horário de início do expediênte",
	"atividade_dataini"=>"Data de início da atividade",
	"item"=>"<strong><br>5. Informações sobre o funcionamento: </strong>"
),
"emp_resp_tecnico"=>array(
	
	"emp_resp_registro"=>"Numero A.R.T. ou similar do representante técnico",
	"emp_resp_regconselho"=>"Registro no conselho do representante técnico",
	"emp_resp_nome"=>"Nome do representante técnico",
	"item"=>"<strong><br>4. Atividade licenciada </strong>"
)
);


$itens = array();
$flag=0;
$contadoor=0;

########################################## QUADRANTE NÃO OBRIGATÓRIO ESPECIFICO ####################################
foreach($quadrantenao_obrigatorio as $key=>$value){
	if(array_key_exists($key,$licform) && isset($licform[$key]) && $licform[$key] == "TRUE"){ //se esta chave existe no _POST então ela provavelmente está setada 
		foreach ($value as $indice => $conteudo) {
			if(is_array($conteudo)){
				foreach ($conteudo as $id => $valor) {
					// echo "<br>".$id."<br>";
					if($id == "sanitarios_disposicao_final" && !array_key_exists('sanitarios_tipo_sistema_publico',$licform)){
						if(empty($licform[$id])){
							$flag=1;
							array_push($itens,$valor);
							// echo "Here6".$valor;debug
						}
					}elseif($id == "liquidos_geracao_outros_esp" && !array_key_exists('liquidos_geracao_outros',$licform)){
						// echo "Here2";debug
					}elseif($id == "agua_outro_especificar" && !array_key_exists('agua_outro',$licform)){
						// echo "Here3";debug
					}elseif($id == "sanitarios_sistema_proprio_esp" && !array_key_exists('sanitarios_tipo_sistema_proprio',$licform)){
						// echo "Here4";debug


					}elseif(array_key_exists($id,$licform) &&(empty($licform[$id]))){
						$flag=1;
						array_push($itens,$valor);
					} 
				}
			}else{
				if($indice == "item"){
					if($flag == 1){
						$flag=0;
						array_push($itens,$conteudo);
					}

				}elseif(!array_key_exists($indice,$licform) || (!is_string($licform[$indice]) || empty($licform[$indice]) || is_null($licform[$indice]))){
					// echo $indice; debug

					$flag=1;
					array_push($itens,$conteudo);
				}
			}
		}
	}
}
$arraySafe = array_merge($quadrante01, $quadrante02, $quadrante03, $quadrante04);

foreach($arraySafe as $key=>$value){
	if(isset($licform[$key])){
		if(is_string($licform[$key])){
			if(!empty($licform[$key])){
			
			}else{echo "$value não foi devidamente preenchido";return 0;}
		}else{echo "$value não foi devidamente preenchido";return 0;}
	}else{echo "$value não foi devidamente preenchido";return 0;}
}


######################################################################FIM QUADRANTES OBRIGATÓRIOS
	// explodi a coordenada em duas para poder tratar
	// retirei o caracter "e" por segurança
	if($licform['emp_coord']){
		$coord[0]= 0 + str_replace("e", "", explode(",", $licform['emp_coord'])[0]);
		$coord[1]= 0 + str_replace("e", "", explode(",", $licform['emp_coord'])[1]);
		$licform['emp_coord'] = implode(",", $coord);
		if(is_float( $coord[0] ) && is_float( $coord[1] )){// para debugar
			// echo "Coordenadas válidas!<br>";
			// echo $coord[0]."<br>";
			// echo $coord[1]."<br>";
			// echo $licform['emp_coord'];
			// return 0;
		}else{
			echo "ERRO, coordenadas inválidas!<br>";
			// echo $coord[0]."<br>";
			// echo $coord[1]."<br>";
			echo $licform['emp_coord'];
			return 0;
		}
	}else{
		echo "ERRO! Coordenadas fornecidas são invalidas.<br>";
		return 0;
	}
######################################################################4o QUADRANTE OBRIGATÓRIO (temporariamente)
	$campos=$valores=array();
	foreach($licform as $campo=>$valor){
		$campos[]=$campo;
		if(array_key_exists($campo,$quadrante_checkbox) && $valor == "TRUE"){
			$valores[] = $valor;
		}elseif(is_string($valor)){
			$valor = str_replace("'", "`", $valor);
			$valor = str_replace("\"", "`", $valor);
			$valores[] = "'".$valor."'";
		}else{
			$valores[] = $valor;
		}
	}

	

	
	$update="";
	foreach($campos as $key=>$value){
		$update.=$value.'='.$valores[$key].",";
	}
	$size = strlen($update);
	$update = substr($update,0, $size-1);

###################################################################### INSERÇÕES MANUAIS
	$campos[] = "time_criacao";
	$valores[] = 'now()';

	$campos[] = "atividade_descr";
	$valor = implode('', $this->execQuery("SELECT descricao FROM uni__licam_atividades_tabela WHERE codramo ='".$licform['atividade_cod']."'")['result'][0]);
	$valor = "'".$valor."'";
	$valores[] = $valor;
	if($_SESSION['uni_ext_form_op'] == "envio"){
		$query = "INSERT INTO uni__xlicam_empreendimentodata (" . implode(',', $campos) . ") VALUES (" . implode(',', $valores) . ")";
	}else{
		$query = "UPDATE uni__xlicam_empreendimentodata SET ".$update." WHERE id = ".$_SESSION['licenciamentos'][$_SESSION['uni_ext_id_form']];		
	}
	$concat="";
	// echo $query;
	if(empty($itens)){
		$result = $this->execQuery($query);
			$status = "";
			if($result['status'] == 1){
				$status = "ok";//somente quando estiver pronto
			}else{
				foreach ($itens as $key => $value) {
					$concat.=$value.",";
				}
				$status = $concat;//somente quando estiver pronto
			}
			echo $status; //endEnvia
	}else{
		foreach ($itens as $key => $value){
			if($key == 0){$concat.=array_pop($itens);	
			}else{$concat.=array_pop($itens).", ";}
			
		}
		$concat = substr($concat,0, strlen($concat)-2);
		echo "<strong>Os seguintes itens não foram devidamente preenchidos: <br></strong>".$concat.".";
	}

?>