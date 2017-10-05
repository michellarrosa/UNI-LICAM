<?php

	$form = $_POST['dados'];
	$query = "SELECT * FROM uni__licam_empreendimentodata WHERE id = $form";
	$result = $this->execQuery($query)['result'][0];	
	$validacao = array();
	
	$status ="";
	$iten_vazio= array();
	
##################################################### VALIDAÇÃO DO FORMULÁRIO, PARA COMPLETA FINALIZAÇÃO ##########################################
	/*
		KEY É O ID E VALUE A MENSAGEM
		foreach($quadrante05 as $key=>$value){
			echo $key."<br>";
		}
		
		item_vazio -> Mostra o "fieldset" que encontra-se vazio exemplo: "1.informação sobre empreendedor";
		validacao-> Mostra qual item dentro do fieldset não foi preenchido. Ex:"Campo nome está vazio";
	*/
	
###################################################### QUADRANTE 5 ################################################################################## 
	$quadrante05 = array("atividade_dataini"=>"Data de Início da Atividade","atividade_horainicio"=>"Horário de Início da Atividade","atividade_horaintervalo"=>"Horário de Inicio do Intervalo da Atividade","atividade_horaintervalofim"=>"Horário de Fim do Intervalo","atividade_horaencerramento"=>"Horário de Encerramento da Atividade");
	
	
	if(empty($result["atividade_iniciada"])){   //verifico se o usuario marcou o item SIM OU NÃO, nesta etapa
		$item_vazio[1] = "5. Informações Sobre o Funcionamento"; //SE NÃO TIVER MARCADO APENAS GUARDO O AVISO DE QUAL ITEM
	}elseif($result["atividade_iniciada"] == TRUE){ //SE TIVER MARCADO SIM, ANALIZSO QUAIS ITENS DENTRO DESTE QUADRANTE NÃO FORAM MARCADOS
		foreach($quadrante05 as $key=>$value){
			if(empty($result[$key])){ 
				$item_vazio[1] = "5. Informações Sobre o Funcionamento"; //IDENTIFICAÇÃO DE QUAL AREA ESTÁ VAZIA
				$validacao[$key] = $value; //E ARMAZENO O ID DO ITEM
			}
		}
	}
###################################################### QUADRANTE 6 ##################################################################################	
	$quadrante06 = array("equipamentos_tabela"=>"Tabela de Equipamentos");
	if(empty($result["equipamentos_utilizacao"])){   //verifico se o usuario marcou o item SIM OU NÃO, nesta etapa
		$item_vazio[2] = "6. Relação dos equipamentos utilizados no empreendimento"; //SE NÃO TIVER MARCADO APENAS GUARDO O AVISO DE QUAL ITEM
	}elseif($result["equipamentos_utilizacao"] == TRUE){ //SE TIVER MARCADO SIM, ANALIZSO QUAIS ITENS DENTRO DESTE QUADRANTE NÃO FORAM MARCADOS
		if(empty($result['equipamentos_tabela'])){ 
			$item_vazio[2] = "6. Relação dos equipamentos utilizados no empreendimento"; //IDENTIFICAÇÃO DE QUAL AREA ESTÁ VAZIA
			$validacao['equipamentos_tabela'] = "Tabela de Equipamentos"; //E ARMAZENO O ID DO ITEM
		}
	}
###################################################### QUADRANTE 7 ##################################################################################	

	if(empty($result["producao_processo"])){   //verifico se o usuario marcou o item SIM OU NÃO, nesta etapa
		$item_vazio[3] = "7. Relação de produção e/ou serviços do empreendimento"; //SE NÃO TIVER MARCADO APENAS GUARDO O AVISO DE QUAL ITEM
	}elseif($result["producao_processo"] == TRUE){ //SE TIVER MARCADO SIM, ANALIZSO QUAIS ITENS DENTRO DESTE QUADRANTE NÃO FORAM MARCADOS
		if(empty($result['producao_tabela'])){ 
			$item_vazio[3] = "7. Relação de produção e/ou serviços do empreendimento"; //IDENTIFICAÇÃO DE QUAL AREA ESTÁ VAZIA
			$validacao['producao_tabela'] = "Tabela de Produção"; //E ARMAZENO O ID DO ITEM 
		}elseif(empty($result['producao_descricao'])){
			$item_vazio[3] = "7. Relação de produção e/ou serviços do empreendimento";
			$validacao['producao_descricao'] = "Descrição do processo produtivo"; //E ARMAZENO O ID DO ITEM 
		}
	}
	
	if(empty($result["prestacao_servico"])){   //verifico se o usuario marcou o item SIM OU NÃO, nesta etapa
		$item_vazio[3] = "7. Relação de produção e/ou serviços do empreendimento"; //SE NÃO TIVER MARCADO APENAS GUARDO O AVISO DE QUAL ITEM
	}elseif($result["prestacao_servico"] == TRUE){ //SE TIVER MARCADO SIM, ANALIZSO QUAIS ITENS DENTRO DESTE QUADRANTE NÃO FORAM MARCADOS
		if(empty($result['prestacao_tabela'])){ 
			$item_vazio[3] = "7. Relação de produção e/ou serviços do empreendimento"; //IDENTIFICAÇÃO DE QUAL AREA ESTÁ VAZIA
			$validacao['producao_tabela'] = "Tabela de prestação de serviço"; //E ARMAZENO O ID DO ITEM 
		}elseif(empty($result['prestacao_descricao'])){
			$item_vazio[3] = "7. Relação de produção e/ou serviços do empreendimento";
			$validacao['prestacao_descricao'] = "Descrição da prestação de serviço"; //E ARMAZENO O ID DO ITEM 
		}
	}

###################################################### QUADRANTE 8 ##################################################################################
	$quadrante08 = array("agua_redepublica"=>"Rede Publica","agua_rioouarroio"=>"Rios ou Arroios","agua_poco"=>"Poço","agua_outro"=>"Outro");
	
	if(empty($result["agua_consumo"])){   //verifico se o usuario marcou o item SIM OU NÃO, nesta etapa
		$item_vazio[4] = "8. Informações Sobre o Consumo de Água"; //SE NÃO TIVER MARCADO APENAS GUARDO O AVISO DE QUAL ITEM
	}elseif($result["agua_consumo"] == TRUE){ //SE TIVER MARCADO SIM, ANALISO QUAIS ITENS DENTRO DESTE QUADRANTE NÃO FORAM MARCADOS
		if(!empty($result['agua_redepublica']) || !empty($result['agua_rioouarroio']) || !empty($result['agua_poco']) || !empty($result['agua_outro'])){
			//SE PELO MENOS UM FOR DIFERENTE DE VAZIO
		}else{
			$item_vazio[4] = "8. Informações Sobre o Consumo de Água"; //IDENTIFICAÇÃO DE QUAL AREA ESTÁ VAZIA
			if(!empty($result['agua_outro'])){ //SE ESTA OPCAO FOI MARCADA ENTÃO VERIFICO SE A DESCRIÇÃO FOI PREENCHIDA
				if(empty($result['agua_outro_especificar'])){
					$validacao['agua_outro_especificar'] = "Descrição do tipo de tratamento."; //E ARMAZENO O ID DO ITEM
				}
			}
		}
	}

###################################################### QUADRANTE 9 ##################################################################################

	if(empty($result["sanitarios_geracao"])){   //verifico se o usuario marcou o item SIM OU NÃO, nesta etapa
		$item_vazio[5] = "9. Efluentes Líquidos Sanitários"; //SE NÃO TIVER MARCADO APENAS GUARDO O AVISO DE QUAL ITEM
	}elseif($result["sanitarios_geracao"] == TRUE){ //SE TIVER MARCADO SIM, ANALIZSO QUAIS ITENS DENTRO DESTE QUADRANTE NÃO FORAM MARCADOS
		if(!empty($result['sanitarios_tipo_sistema_publico']) || !empty($result['sanitarios_tipo_nao_possui']) || !empty($result['sanitarios_tipo_sistema_proprio'])){
			//SE PELO MENOS UM FOR DIFERENTE DE VAZIO
		}else{
			$item_vazio[5] = "9. Efluentes líquidos sanitários"; //SE NÃO TIVER MARCADO APENAS GUARDO O AVISO DE QUAL ITEM
			if(!empty($result['sanitarios_tipo_sistema_proprio'])){ //SE ESTA OPCAO FOI MARCADA ENTÃO VERIFICO SE A DESCRIÇÃO FOI PREENCHIDA
				if(empty($result['sanitarios_sistema_proprio_esp'])){
					$validacao['sanitarios_sistema_proprio_esp'] = "Especificação do sistema próprio."; //E ARMAZENO O ID DO ITEM
				}
			}		
		}
		
		if(empty($result['sanitarios_tipo_sistema_publico'])){ //se aqui esta vazio então este abaixo deve estar preenchido, caso contrario não
			$item_vazio[5] = "9. Efluentes líquidos sanitários"; //SE NÃO TIVER MARCADO APENAS GUARDO O AVISO DE QUAL ITEM
			if(empty("sanitarios_disposicao_final")){
				$validacao['sanitarios_disposicao_final'] = "Disposição final dos efluentes sanitários"; //E ARMAZENO O ID DO ITEM
			}
		}
		if(empty("sanitarios_reaproveita")){
			$item_vazio[5] = "9. Efluentes líquidos sanitários"; //SE NÃO TIVER MARCADO APENAS GUARDO O AVISO DE QUAL ITEM
			$validacao['sanitarios_reaproveita'] = "Reaproveitamento dos efluentes sanitários: "; //E ARMAZENO O ID DO ITEM			
		}elseif($result["sanitarios_reaproveita"] == "Total" || $result["sanitarios_reaproveita"] == "Parcial"){
			if(empty("sanitarios_reaproveita_esp")){
				$item_vazio[5] = "9. Efluentes Líquidos Sanitários"; //SE NÃO TIVER MARCADO APENAS GUARDO O AVISO DE QUAL ITEM
				$validacao['sanitarios_reaproveita_esp'] = "Especificação do reaproveitamento dos efluentes sanitários"; //E ARMAZENO O ID DO ITEM
			}
		}

	}	
###################################################### QUADRANTE 10 ##################################################################################

	if(empty($result["liquidos_geracao"])){   //verifico se o usuario marcou o item SIM OU NÃO, nesta etapa
		$item_vazio[6] = "10. Efluentes Líquidos Indústriais"; //SE NÃO TIVER MARCADO APENAS GUARDO O AVISO DE QUAL ITEM
	}elseif($result["liquidos_geracao"] == TRUE){ //SE TIVER MARCADO SIM, ANALISO QUAIS ITENS DENTRO DESTE QUADRANTE NÃO FORAM MARCADOS
		if(empty("liquidos_gerecao_esp")){
			$item_vazio[6] = "10. Efluentes Líquidos Indústriais"; //SE NÃO TIVER MARCADO APENAS GUARDO O AVISO DE QUAL ITEM
			$validacao['liquidos_gerecao_esp'] = "Especificação do tratamento dos efluentes liquidos industriais"; //E ARMAZENO O ID DO ITEM			
		}
		
		if(!empty($result['liquidos_geracao_processo_prod']) || !empty($result['liquidos_geracao_refrigeracao']) || !empty($result['liquidos_geracao_lavagem']) ||($result['liquidos_geracao_lavag_veiculos']) || !empty($result['liquidos_geracao_outros'])){
			//SE PELO MENOS UM ESTIVER MARCADO, TUDO OK	
		}else{
		$item_vazio[6] = "10. Efluentes Líquidos Indústriais"; //SE NÃO TIVER MARCADO APENAS GUARDO O AVISO DE QUAL ITEM
			if(!empty($result['liquidos_geracao_outros'])){ //SE ESTA OPCAO FOI MARCADA ENTÃO VERIFICO SE A DESCRIÇÃO FOI PREENCHIDA
				if(empty($result['liquidos_geracao_outros_esp'])){
					$validacao['liquidos_geracao_outros_esp'] = "Especificar etapa de geração dos Efluentes Líquidos Indústriais"; //E ARMAZENO O ID DO ITEM
				}
			}			
		}	
		if(empty($result['liquidos_disposicao'])){ //SE ESTA OPCAO FOI MARCADA ENTÃO VERIFICO SE A DESCRIÇÃO FOI PREENCHIDA
			$item_vazio[6] = "10. Efluentes Líquidos Indústriais"; //SE NÃO TIVER MARCADO APENAS GUARDO O AVISO DE QUAL ITEM
			$validacao['liquidos_disposicao'] = "Disposição dos Efluentes Líquidos Indústriais"; //E ARMAZENO O ID DO ITEM
		}
		if(empty($result['liquidos_reaproveita'])){
			$item_vazio[6] = "10. Efluentes Líquidos Indústriais"; //SE NÃO TIVER MARCADO APENAS GUARDO O AVISO DE QUAL ITEM
			$validacao['liquidos_reaproveita'] = "Reaproveitamento dos Efluentes Líquidos Indústriais"; //E ARMAZENO O ID DO ITEM
		}elseif($result['liquidos_reaproveita'] == "Total"|| $result['liquidos_reaproveita'] == "Parcial"){
			if(empty($result['liquidos_reaproveita_esp'])){
				$item_vazio[6] = "10. Efluentes Líquidos Indústriais"; //SE NÃO TIVER MARCADO APENAS GUARDO O AVISO DE QUAL ITEM
				$validacao['liquidos_reaproveita_esp'] = "Reaproveitamento dos Efluentes Líquidos Indústriais"; //E ARMAZENO O ID DO ITEM				
			}
		}
	}
###################################################### QUADRANTE 11 ##################################################################################
	if(empty($result['atm_geracao'])){
		$item_vazio[7] = "11. Emissões Sonoras e Atmosféricas"; //SE NÃO TIVER MARCADO APENAS GUARDO O AVISO DE QUAL ITEM
	}elseif($result['atm_geracao'] == TRUE){
		if(empty($result['atm_geracao_esp'])){
			$item_vazio[7] = "11. Emissões Sonoras e Atmosféricas"; //SE NÃO TIVER MARCADO APENAS GUARDO O AVISO DE QUAL ITEM
			$validacao['atm_geracao_esp'] = "Descrição das fontes geradoras e dos mecanismos de controle"; //E ARMAZENO O ID DO ITEM			
		}
	}

###################################################### QUADRANTE 12 ##################################################################################
	if(empty($result['solidos_geracao'])){
		$item_vazio[8] = "12. Resíduos Sólidos"; //SE NÃO TIVER MARCADO APENAS GUARDO O AVISO DE QUAL ITEM
	}elseif($result['solidos_geracao'] == TRUE){
		if(empty($result['solidos_geracao_esp'])){
			$item_vazio[8] = "12. Resíduos Sólidos"; //SE NÃO TIVER MARCADO APENAS GUARDO O AVISO DE QUAL ITEM
			$validacao['solidos_geracao_esp'] = "Descrição dos resíduos sólidos"; //E ARMAZENO O ID DO ITEM			
		}
	}
###################################################### QUADRANTE 13 ##################################################################################
	if(empty($result['vegetacao_areautil'])){
		$item_vazio[9] = "13. Vegetação"; //SE NÃO TIVER MARCADO APENAS GUARDO O AVISO DE QUAL ITEM
	}elseif($result['vegetacao_areautil'] == TRUE){
		if(empty($result['vegetacao_intervencao'])){
			$item_vazio[9] = "13. Vegetação"; //SE NÃO TIVER MARCADO APENAS GUARDO O AVISO DE QUAL ITEM
			$validacao['vegetacao_intervencao'] = "Intervenção na vegetação"; //E ARMAZENO O ID DO ITEM			
		}
	}

  $status_final = array("itens"=>$item_vazio, "campos"=>$validacao);
	// json_encode($status_final);
	print_r($status_final);
	
	
	
?>