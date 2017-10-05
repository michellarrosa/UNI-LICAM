<?php 
session_start();
header('Content-Type: text/html; charset=UTF-8');

setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portugues	e');
date_default_timezone_set('America/Sao_Paulo');

	if(!in_array($_REQUEST['dados'],$_SESSION['licenciamento'])){
		$query = "SELECT * FROM uni__licam_empreendimentodata WHERE id = '".$_SESSION['licenciamentos'][$_REQUEST['dados']]."'";
		$result = $this->execQuery($query)['result'][0];
		$atividade = implode('', $this->execQuery("SELECT descricao FROM com_licam.atividades_tabela WHERE codramo ='".$result['atividade_cod']."'")['result'][0]);

		$lista_estados= array("AC"=>"AC - Acre","AL"=>"AL - Alagoas","AP"=>"AP - Amapá","AM"=>"AM - Amazonas","BA"=>"BA - Bahia","CE"=>"CE - Ceará","DF"=>"DF - Distrito Federal","ES"=>"ES - Espírito Santo","GO"=>"GO - Goiás","MA"=>"MA - Maranhão","MT"=>"MT - Mato Grosso","MS"=>"MS - Mato Grosso do Sul","MG"=>"MG - Minas Gerais","PA"=>"PA - Pará","PB"=>"PB - Paraíba","PR"=>"PR - Paraná	","PE"=>"PE - Pernambuco","PI"=>"PI - Piauí","RJ"=>"RJ - Rio de Janeiro","RN"=>"RN - Rio Grande do Norte","RS"=>"RS - Rio Grande do Sul","RO"=>"RO - Rondônia","RR"=>"RR - Roraima","SC"=>"SC - Santa Catarina","SP"=>"SP - São Paulo","SE"=>"SE - Sergipe","TO"=>"TO - Tocantins");	

		$lista_licencas= array("NL"=>"Não Licenciável","LF"=>"Licenciável pela FEPAM","LU"=>"Licença Única","RLU"=>"Renovação de Licença Única","LP"=>"Licença Prévia ","RLP"=>"Renovação de Licença Prévia","LI"=>"Licença de Instalação ","RLI"=>"Renovação de Licença de Instalação ","LO"=>"Licença Operação","RLO"=>"Renovação de Licença de Operação","LOR"=>"Regularização de LO");	

		$lista_dias= array("atividade_seg"=>"Segunda-Feira","atividade_ter"=>"Terça-Feira","agua_poco"=>" ","atividade_qui"=>"Quinta-Feira","atividade_sex"=>"Sexta-Feira","atividade_sab"=>"Sábado ","atividade_dom"=>"Domingo");

		$lista_agua= array("agua_redepublica"=>"Rede Pública","agua_rioouarroio"=>"Rios ou Arrios","agua_poco"=>"Poço ","agua_outro"=>"outro");	




		$date_de_criacao =  utf8_encode(strftime('%d de %B de %Y', strtotime(date('d-m-Y', strtotime($result['time_criacao'])))));
		###################################### TRATAMENTO DOS QUADRANTES ONE-BY-ONE ############################################

		###########################################RESPONSAVEL TECNICO##########################################################
		$responsavel_tecnico="";
		if($result['emp_resp_tecnico'] == "TRUE"){
			$responsavel_tecnico ="
						<tr>
						<td colspan='12'><b>Há responsável técnico pelo processo?: </b>Sim</td>
							
						</tr>
						<tr>
							<td colspan='4'><b>Nome do responsável técnico:</b> ".$result['emp_resp_nome']."</td>
								<td colspan='4'><b>Número do registro no conselho</b>: ".$result['emp_resp_regconselho']."</td>
								<td colspan='4'><b>Número de A.R.T. ou similar</b>: ".$result['emp_resp_registro']."</td>
						</tr>";
		}else{
		$responsavel_tecnico ="
						<tr>
						<td colspan='16'><b>Há responsável técnico pelo processo?: </b>Não</td>
							
						</tr>";

		}

		###########################################ATIVIDADE INICIADA############################################################
		$atividade_iniciada="";
		$dias="";
		if($result['atividade_iniciada'] == "TRUE"){

			foreach ($lista_dias as $key => $value){
				if($result[$key] == TRUE){
					$dias.=$value.",";
				}
			}
			$dias = rtrim($dias,',');

			$atividade_iniciada ="
			<tr>
			<td colspan='16'><b>Atividade já iniciada?</b> Sim</td>
			</tr>
			<tr>
				<td colspan='16'><b>Data de Início da Atividade:</b> ".date("d-m-Y",strtotime($result['atividade_dataini']))."</td>
			</tr>
			<tr>
					<td colspan='16'><b><center>Horário de Expediente</center></td>
			</tr>
			<tr>
					<td colspan='4'><b>Início</b>: ".$result['atividade_horainicio']."</td>
					<td colspan='4'><b>Início do Intervalo</b>: ".$result['atividade_horaintervalo']."</td>
					<td colspan='4'><b>Fim do Intervalo</b>: ".$result['atividade_horaintervalofim']."</td>
					<td colspan='4'><b>Encerramento</b>: ".$result['atividade_horaencerramento']."</td>
			</tr>
			<tr>
				<td colspan='16'><b><center>Dias de funcionamento na semana</center></td>
			</tr>
			<tr>
				<td colspan='16'> ".$dias."</td>
			</tr>

			";


		}else{
			$atividade_iniciada ="
			<tr>
			<td colspan='16'><b>Atividade já iniciada? Não</td>
			</tr>";
		}

		###########################################CONSUMO DE AGUA#########################################################

		$agua_consumo="";
		$consumo="";
		$consumo_descricao="";
		if($result['agua_consumo'] == "TRUE"){

			foreach ($lista_agua as $key => $value){
				if($result[$key] == TRUE){
					$consumo.=$value.",";
				}
			}
			$consumo = rtrim($consumo,',');
			$agua_consumo ="
			<tr>
				<td colspan='8'><b>Há consumo de água no empreendimento?</b> Sim</td>
				 <td colspan='8'><b>Forma de Abastecimento</b>:".$consumo."</td>
			</tr>
			";
			if($result['agua_outro'] == TRUE){
				$consumo_descricao=$result['agua_outro_especificar'];
				$agua_consumo .="	<tr>
				<td colspan='16'><b>Descrição</b>: ".$consumo_descricao."</td>
			</tr>";
			}	

			


		}else{
			$agua_consumo ="
			<tr>
			<td colspan='16'><b>Há consumo de água no empreendimento?</b> Não</td>
			</tr>";

		}

		#############################################UTILIZAÇÃO DE EQUIPAMENTOS#############################################################
		$equipamentos_utilizacao="";
		if($result['equipamentos_utilizacao'] == "TRUE"){
							$equipamentos_utilizacao ="	
			<tr>
				<td colspan='18'><b>Há utilização de equipamentos na operação/atividade do empreendimento?</b> Sim</td>
			</tr>
			<tr>
				<td colspan='6'><center><b>Equipamentos</b></center></td>
				<td colspan='6'><center><b>Descrição</b></center></td>
				<td colspan='6'><center><b>Quantidade</b></center></td>
			</tr>
		";	
						$utilizacao_equipamentos = (explode('\n',$result['equipamentos_tabela']));
						array_pop($utilizacao_equipamentos);
				foreach($utilizacao_equipamentos AS $key=>$value){			
					$coluna_equipamentos = (explode('\t',$utilizacao_equipamentos[$key]));
					$equipamentos_utilizacao.="
			
						<tr>
							<td colspan='6'>$coluna_equipamentos[0]</td>
							<td colspan='6'>$coluna_equipamentos[1]</td>
							<td colspan='6'>$coluna_equipamentos[2]</td>
						</tr><br>";
				}
		}else{
			$equipamentos_utilizacao ="	
			<tr>
				<td colspan='16'><b>Há utilização de equipamentos na operação/atividade do empreendimento?</b> Não</td>
			</tr>";
		}

		########################################PRODUÇÃO (TABELA)###########################################################	
		$producao_processo="";
		if($result['producao_processo'] == "TRUE"){
							$producao_processo ="	
			<tr>
				<td colspan='18'><b>Há processo produtivo no empreendimento?</b> Sim</td>
			</tr>
			<tr>
				<td colspan='6'><center><b>Produto Fina</b></center></td>
				<td colspan='6'><center><b>Quantidade Produzida/Mês</b></center></td>
				<td colspan='6'><center><b>Forma de Acondicionamento</b></center></td>

			</tr>
		";
						$producao = (explode('\n',$result['producao_tabela']));
						array_pop($producao);
				foreach($producao AS $key=>$value){			
					$coluna = (explode('\t',$producao[$key]));
					$producao_processo.="
			
						<tr>
							<td colspan='6'>$coluna[0]</td>
							<td colspan='6'>$coluna[1]</td>
							<td colspan='6'>$coluna[2]</td>
						</tr>";
				}
				$producao_processo.="
					<tr>
					<td colspan='18'><b>Etapas do processo produtivo industrial, desde a entrada da matéria-prima até a saída do produto final, incluindo as principais informações de cada etapa:</b> ".$result['producao_descricao']."</td>
					</tr>
					
				";




		}else{
			$producao_processo ="	
			<tr>
				<td colspan='16'><b>Há processo produtivo no empreendimento?</b> Não</td>
			</tr>";
		}

		######################################SERVIÇOS PRESTADOS###############################################################	
		$prestacao_servico="";
		if($result['prestacao_servico'] == "TRUE"){
							$prestacao_servico ="	
			<tr>
				<td colspan='18'><b>Há prestação de serviço no empreendimento?</b> Sim</td>
			</tr>
			<tr>
				<td colspan='6'><center><b>Serviço Prestado</b></center></td>
				<td colspan='6'><center><b>Quantidade Produzida/Mês</b></center></td>
				<td colspan='6'><center><b>Forma de Prestação</b></center></td>

			</tr>
		";
				$prestacao = (explode('\n',$result['prestacao_tabela']));
						array_pop($prestacao);
				foreach($prestacao AS $key=>$value){			
					$coluna_prestacao = (explode('\t',$prestacao[$key]));
					$prestacao_servico.="	
						<tr>
							<td colspan='6'>$coluna_prestacao[0]</td>
							<td colspan='6'>$coluna_prestacao[1]</td>
							<td colspan='6'>$coluna_prestacao[2]</td>
						</tr><br>";
				}
				$prestacao_servico.="
					<tr>
					<td colspan='18'><b>Etapas do processo de prestação dos serviços, incluindo as principais informações de cada etapa: </b> ".$result['prestacao_descricao']."</td>
					</tr>
				";

				

				
		}else{
			$producao_processo ="	
			<tr>
				<td colspan='16'><b>Há prestação de serviço no empreendimento?</b> Não</td>
			</tr>";
		}

		######################################################################################################################	

		#########################################SANITARIOS GERAÇÃO###########################################################	
		$sanitarios_geracao="";
		$tipo_sistema="";
		$tipo_sistemaDescricao="";
		if($result['sanitarios_geracao'] == "TRUE"){
		$sanitarios_geracao ="	
			<tr>
				<td colspan='16'><b>Há geração de efluentes sanitários no empreendimento?</b> Sim</td>
			</tr>";
			if($result['sanitarios_tipo_sistema_proprio'] == TRUE){
				$tipo_sistema.="Sistema de tratamento próprio";
				$tipo_sistemaDescricao = $result['sanitarios_sistema_proprio_esp'];
				if($result['sanitarios_reaproveita'] =="Total" ||$result['sanitarios_reaproveita'] =="Parcial"){
					$sanitarios_geracao .= "<tr>
					<td><b>Tipo de destinação dos efluentes sanitários: </b> $tipo_sistema </td>
					<td><b>Disposição final dos efluentes sanitários: </b>".$result['sanitarios_disposicao_final']."</td>
					<td><b>Reaproveitamento dos efluentes sanitários: </b>".$result['sanitarios_reaproveita']."</td>
					</tr>
					<tr>
					<td colspan='16'><b>Especificar reaproveitamento dos efluentes sanitários: </b> ".$result['sanitarios_reaproveita_esp']." </td>
					</tr>";
				}else{
					$sanitarios_geracao .= "<tr>
					<td><b>Tipo de Destinação dos Efluentes Sanitários:</b> $tipo_sistema </td>
					<td><b>Disposição Final dos Efluentes Sanitários:</b>".$result['sanitarios_disposicao_final']."</td>
					<td><b>Reaproveitamento dos Efluentes Sanitários:</b> Não Há Reaproveitamento</td>
					</tr>";
				}
			}
			if($result['sanitarios_tipo_nao_possui'] == TRUE){
				$tipo_sistema.="Não possui sistema de tratamento";
				if($result['sanitarios_reaproveita'] =="Total" ||$result['sanitarios_reaproveita'] =="Parcial"){
					$sanitarios_geracao .= "<tr>
					<td><b>Tipo de Destinação dos Efluentes Sanitários:</b> $tipo_sistema </td>
					<td><b>Disposição Final dos Efluentes Sanitários:</b>".$result['sanitarios_disposicao_final']."</td>
					<td><b>Reaproveitamento dos Efluentes Sanitários:</b>".$result['sanitarios_reaproveita']."</td>
					</tr>
					<tr>
					<td colspan='16'><b>Especificar Reaproveitamento dos Efluentes Sanitários: </b> ".$result['sanitarios_reaproveita_esp']." </td>
					</tr>";
				}else{
					$sanitarios_geracao .= "<tr>
					<td><b>Tipo de Destinação dos Efluentes Sanitários:</b> $tipo_sistema </td>
					<td><b>Disposição Final dos Efluentes Sanitários:</b>".$result['sanitarios_disposicao_final']."</td>
					<td><b>Reaproveitamento dos Efluentes Sanitários:</b> Não Há Reaproveitamento</td>
					</tr>";
				}	
					
			}
			if($result['sanitarios_tipo_sistema_publico'] == TRUE){
				$tipo_sistema.="Rede Pública Coletora";
				if($result['sanitarios_reaproveita'] =="Total" ||$result['sanitarios_reaproveita'] =="Parcial"){
					$sanitarios_geracao .= "<tr>
					<td><b>Tipo de Destinação dos Efluentes Sanitários:</b> $tipo_sistema </td>
					<td><b>Reaproveitamento dos Efluentes Sanitários:</b>".$result['sanitarios_reaproveita']."</td>
					</tr>
					<tr>
					<td colspan='16'><b>Especificar Reaproveitamento dos Efluentes Sanitários: </b> ".$result['sanitarios_reaproveita_esp']." </td>
					</tr>";
				}else{
					$sanitarios_geracao .= "<tr>
					<td><b>Tipo de Destinação dos Efluentes Sanitários:</b> $tipo_sistema </td>
					<td><b>Reaproveitamento dos Efluentes Sanitários:</b> Não Há Reaproveitamento</td>
					</tr>";
				}
				
			}
				

				
		}else{
			$sanitarios_geracao ="	
			<tr>
				<td colspan='16'><b>Há geração de Efluentes Sanitários no empreendimento?</b> Não</td>
			</tr>";
		}

		#############################################LIQUIDOS GERAÇÃO#######################################################	
		$lista_geracao= array("liquidos_geracao_processo_prod"=>"Processo de produção","liquidos_geracao_refrigeracao"=>"Refrigeração","liquidos_geracao_lavagem"=>"Lavagem de pisos e equipamentos ","liquidos_geracao_lavag_veiculos"=>"Lavagem de veículos","liquidos_geracao_outros"=>"Outros");	

		$liquidos_geracao="";
		$geracao="";
		if($result['liquidos_geracao'] == "TRUE"){
			$liquidos_geracao ="	
			<tr>
				<td colspan='16'><b>Há geração de efluentes líquidos industriais no empreendimento?</b> Sim</td>
			</tr>
			<tr>	
				<td><b>Especificar tipo de tratamento dos Efluentes Líquidos Industriais:</b> ".$result['liquidos_gerecao_esp']."</td>
			</tr>
			";
			foreach ($lista_geracao as $key => $value){
				if($result[$key] == TRUE){
					$geracao.=$value.",";
				}
			}
			$geracao = rtrim($geracao,',');
			$liquidos_geracao.="<tr>
				<td><b>Em qual etapa? </b>" .$geracao."</td>
			</tr>";
			if($result['liquidos_geracao_outros'] == TRUE){
				$liquidos_geracao.=	"<tr>	
				<td><b>Especificações de outras etapas de geração dos Efluentes Líquidos Industriais: </b> ".$result['liquidos_geracao_outros_esp']."</td>
			</tr>"; 
			}
			
			
			if($result['liquidos_reaproveita'] =="Total" ||$result['liquidos_reaproveita'] =="Parcial"){
				$liquidos_geracao.=	"
					<tr>	
						<td><b>Disposição final dos efluentes líquidos industriais: </b>".$result['liquidos_disposicao']."</td>
					</tr>
					<tr>	
						<td><b>Reaproveitamento dos efluentes líquidos industriais: </b>".$result['liquidos_reaproveita']."</td>
					</tr>
					<tr>	
						<td><b>Especificar reaproveitamento dos efluentes industriais: </b> ".$result['liquidos_reaproveita_esp']."</td>
					</tr>";
			}else{
				$liquidos_geracao.=	"
					<tr>	
						<td><b>Disposição final dos efluentes líquidos industriais: </b>".$result['liquidos_disposicao']."</td>
					</tr>
					<tr>	
						<td><b>Reaproveitamento dos efluentes líquidos industriais: </b>".$result['liquidos_reaproveita']."</td>
					</tr>";
			}
			

			

				
		}else{
			$liquidos_geracao ="	
			<tr>
				<td colspan='16'><b>Há geração de efluentes líquidos industriais no empreendimento?</b>: Não</td>
			</tr>";
		}

		// ###########################################GERAÇÃO ATM#######################################################	
		$atm_geracao="";
		if($result['atm_geracao'] == "TRUE"){
			$atm_geracao ="
						<tr>
						<td colspan='12'><b>Há geração de emissões sonoras e/ou atmosféricas no empreendimento?</b>Sim</td>
							
						</tr>
						<tr>
							<td colspan='12'><b>Descrição das fontes geradoras e dos mecanismos de controle: </b> ".$result['atm_geracao_esp']."</td>
						</tr>";
		}else{
		$atm_geracao ="
						<tr>
						<td colspan='12'><b>Há geração de emissões sonoras e/ou atmosféricas no empreendimento? </b>Não</td>
							
						</tr>";

		}

		##################################################SOLIDOS GERAÇÃO######################################################	

		$solidos_geracao="";
		if($result['solidos_geracao'] == "TRUE"){
			$solidos_geracao ="
						<tr>
						<td colspan='12'><b>Há geração de resíduos sólidos no empreendimento? </b>Sim</td>
							
						</tr>
						<tr>
							<td colspan='12'><b>Descrição(tipo, acondicionamento, destinação final, entre outros): </b> ".$result['solidos_geracao_esp']."</td>
						</tr>";
		}else{
		$solidos_geracao ="
						<tr>
						<td colspan='12'><b>Há geração de resíduos sólidos no empreendimento? </b>Não</td>
							
						</tr>";

		}

		########################################3VEGETAÇÃO#############################################################

		$vegetacao_areautil="";
		$vegetacao_intervencao="";
			if($result['vegetacao_areautil'] == "TRUE"){

				if($result['vegetacao_intervencao'] == "TRUE"){
					$vegetacao_intervencao="Sim";
				}else{
					$vegetacao_intervencao="Não";
				}
				
					$vegetacao_areautil ="
								<tr>
								<td colspan='12'><b>Há vegetação na área útil do empreendimento? </b>Sim</td>
									
								</tr>
								<tr>
									<td colspan='12'><b>Haverá intervenção na vegetação? </b> ".$vegetacao_intervencao."</td>
								</tr>";
			}else{
				$vegetacao_areautil ="
					<tr>
						<td colspan='12'><b>Há vegetação na área útil do empreendimento? </b>Não</td>				
					</tr>";

			}

		########################################FORMULARIO CRIAÇÃO################################################################	



		$table="<form >
			
				<table style='width:100%'>
					<tr>
						<td><center><img src='img/p1.png' width='100px' height='100px'></center>	</td>

					
						<td><center><b>ESTADO DO RIO GRANDE DO SUL</b></center>
				<center><b>PREFEITURA MUNICIPAL DO RIO GRANDE</b></center>
				<center><b>SECRETARIA DE MUNICÍPIO DO MEIO AMBIENTE</b></center></td>

						<td><center><img src='img/p2.png' width='100px' height='100px'></center></td>

					</tr>
			</table>
				<h1><center>Requerimento de Licenciamento Ambiental</center></h1>
			<h4>Processo administrativo n° ____/_____ aberto em ____/____/____.</h4>
			
			<fieldset>
				<legend>1. Identificação do empreendedor</legend>
				<table style='width:100%'>
					<tr>
						<td colspan='3'><b>Nome</b>: ".$result['empreendedor_nome']."</td>
							<td colspan='2'><b>C.P.F.</b>: ".$result['empreendedor_cnpjcpf']."</td>
					</tr>
					<tr>
						<td colspan='3'><b>Endereço para correspondência</b>: ".$result['empreendedor_end_rua']."</td>
						<td><b>N°</b>: ".$result['empreendedor_end_numero']."</td>
						<td><b>Complemento</b>: ".$result['empreendedor_end_complemento']."</td>		     
					</tr>
					<tr>
						<td><b>Bairro</b>: ".$result['empreendedor_end_bairro']."</td>
						<td><b>C.E.P.</b>: ".$result['empreendedor_end_cep']."</td>
						<td><b>Cidade</b>: ".$result['empreendedor_end_cidade']."</td>
						<td colspan='2'><b>Estado</b>: ".$lista_estados[$result['empreendedor_end_estado']]."</td>
					</tr>
					<tr>
						<td colspan='3'><b>E-mail</b>: ".$result['empreendedor_email']."</td>
						<td colspan='2'><b>Telefone</b>: ".$result['empreendedor_telefone']."</td>

					</tr>
				</table>
			</fieldset>
			<fieldset>
				<legend>2. Identificação do empreendimento</legend>
				<table style='width:100%'>
					<tr>
						<td colspan='2'><b>Razão social</b>: ".$result['emp_razaosocial']."</td>
							<td colspan='2'><b>Nome fantasia</b>: ".$result['emp_fantasia']."</td>
							<td colspan='1'><b>C.N.P.J./C.P.F.</b>: ".$result['emp_cnpjcpf']."</td>
					</tr>
					<tr>
						<td colspan='3'><b>Endereço para correspondência</b>: ".$result['emp_end_rua']."</td>
						<td><b>N°</b>: ".$result['emp_end_numero']."</td>
						<td><b>Complemento</b>: ".$result['emp_end_complemento']."</td>		     
					</tr>
					<tr>
						<td><b>Bairro</b>: ".$result['emp_end_bairro']."</td>
						<td><b>C.E.P.</b>: ".$result['emp_end_cep']."</td>
						<td><b>Cidade</b>: ".$result['emp_end_cidade']."</td>
						<td colspan='2'><b>Estado</b>: ".$lista_estados[$result['emp_end_estado']]."</td>
					</tr>
				</table>
			</fieldset>
			<fieldset>
				<legend>3. Localização do empreendimento</legend>
				<table style='width:100%'>
					<tr>
						<td colspan='3'><b>Status do empreendimento</b>: ".$result['emp_status_coord']."</td>
							<td colspan='2'><b>Coordenadas do empreendimento</b>: ".$result['emp_coord']."</td>
					</tr>
				</table>
			</fieldset>
			<fieldset>
				<legend>4. Atividade licenciada</legend>
				<table style='width:100%'>
					<tr>
						<td colspan='12'><b>Código da atividade</b>: ".$result['atividade_cod']."/".$atividade."</td>			    
					</tr>
					<tr>
						<td colspan='3'><b>Tamanho</b>: ".$result['atividade_tamanho']."</td>
						<td colspan='3'><b>Unidade de medida</b>: ".$result['atividade_auto_unid_medida']."</td>
							<td colspan='2'><b>Potencial poluidor</b>: ".$result['atividade_auto_potencialpoluidor']."</td>
							<td colspan='2'><b>Porte</b>: ".$result['atividade_auto_porte']."</td>
							<td colspan='2'><b>Tipo de licença</b>: ".$lista_licencas[$result['tipolicenca']]."</td>
					</tr>
					".$responsavel_tecnico."
				</table>
			</fieldset>
			<br class='quebrapagina'>
			<fieldset>
				<legend>5. Informações sobre o funcionamento</legend>
				<table style='width:100%'>		
					".$atividade_iniciada."
				</table>
			</fieldset>
			<fieldset>
				<legend>6. Relação dos equipamentos utilizados no empreendimento</legend>
				<table style='width:100%'>		
					".$equipamentos_utilizacao."
				</table>
			</fieldset>
			<fieldset>
				<legend>7. Relação de produção e/ou serviços do empreendimento</legend>
				<table style='width:100%'>		
					".$producao_processo.$prestacao_servico."
				</table>
			</fieldset>
			<fieldset>
				<legend>8. Informações sobre o consumo de água</legend>
				<table style='width:100%'>		
					".$agua_consumo."
				</table>
			</fieldset>
			
			<fieldset>
				<legend>9. Efluentes líquidos sanitários</legend>
				<table style='width:100%'>		
					".$sanitarios_geracao."
				</table>
			</fieldset>
			<fieldset>
				<legend>10. Efluentes líquidos industriais</legend>
				<table style='width:100%'>		
					".$liquidos_geracao."
				</table>
			</fieldset>

			<fieldset>
				<legend>11. Emissões sonoras e atmosféricas</legend>
				<table style='width:100%'>		
					".$atm_geracao."
				</table>
			</fieldset>
			<fieldset>
				<legend>12. Resíduos sólidos</legend>
				<table style='width:100%'>		
					".$solidos_geracao."
				</table>
			</fieldset>
			<fieldset>
				<legend>13. Vegetação</legend>
				<table style='width:100%'>		
					".$vegetacao_areautil."
				</table>
			</fieldset>

				<div align='left'>
					<b><i>Formulário de solicitação efetuado em: ".$date_de_criacao."</i></b>
				</div>
				<h2><center>Imprima este requerimento, anexe os documentos e abra processo na SMMA.</center></h2>
			<br>
			<br>
				<center>
				<div>
				_____________________________________________________________
				<br>
							 ASSINATURA DO RESPONSÁVEL PELO LICENCIAMENTO
				</div>
				<center>

		</form>";
										
		echo $table;
	}

	?>


