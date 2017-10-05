<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('default_charset','UTF-8');


// conteúdo importado do DB
$query="select * from com_licam.empreendimentodata where id =".$_REQUEST['p'];
$db=$this->execQuery($query)['result'][0];

// conteúdo estático base
$lista_estados= array("AC"=>"AC - Acre","AL"=>"AL - Alagoas","AP"=>"AP - Amapá","AM"=>"AM - Amazonas","BA"=>"BA - Bahia","CE"=>"CE - Ceará","DF"=>"DF - Distrito Federal","ES"=>"ES - Espírito Santo","GO"=>"GO - Goiás","MA"=>"MA - Maranhão","MT"=>"MT - Mato Grosso","MS"=>"MS - Mato Grosso do Sul","MG"=>"MG - Minas Gerais","PA"=>"PA - Pará","PB"=>"PB - Paraíba","PR"=>"PR - Paraná	","PE"=>"PE - Pernambuco","PI"=>"PI - Piauí","RJ"=>"RJ - Rio de Janeiro","RN"=>"RN - Rio Grande do Norte","RS"=>"RS - Rio Grande do Sul","RO"=>"RO - Rondônia","RR"=>"RR - Roraima","SC"=>"SC - Santa Catarina","SP"=>"SP - São Paulo","SE"=>"SE - Sergipe","TO"=>"TO - Tocantins");	

$tipolicenca = array('LU'=>'Licença Única', 'RLU'=>'Renovação de Licença Única', 'LP'=>'Licença Prévia','RLP'=>'Renovação de LP', 'LI'=>'Licença de Instalação (LI)', 'RLI'=>'Renovação de LI', 'LO'=>'Licença Operação (LO)', 'RLO'=>'Renovação de LO', 'RgLO'=>'Regularização de LO');
// TRATAMENTO DAS VARIÁVEIS

$conteudoHeader = "<p>PROCESSO<br>
									Protocolo: RG-SMMA-2017-'".$db['id']."', Formulário Nº: '". $db['id'] ."', Data-Envio: '".$db['time_criacao'].".</p>
									<p>RESPONSÁVEL<br>
									CPF: '". $db['responsavel_cpf']."' Nome: '".$db['responsavel_cpf']."' .</p>";

$quadrante1ao4 = "
<legend>1. Identificação do Empreendedor</legend>
<div class='form-group'>
	<div class='row'>
		<div class='col-md-8'>
			<label for='empreendedor_nome'>Nome Completo:</label>
			<input type='text' class='form-control'  id='empreendedor_nome' name='empreendedor_nome' readonly  value='".$db['empreendedor_nome']."'>
		</div>
		<div class='col-md-4'>
			<label for='empreendedor_cnpjcpf'>CPF/CNPJ:</label>
			<input type='text' class='form-control' maxlength='18' id='empreendedor_cnpjcpf' name='empreendedor_cnpjcpf' readonly value='".$db['empreendedor_cnpjcpf']."' >
		</div>
	</div>
</div>
<div class='form-group'>
	<div class='row'>
		<div class='col-md-6'>
			<label for='empreendedor_end_rua'>Endereço para Corrêspondencia:</label>
			<input type='text' class='form-control'  id='empreendedor_end_rua' name='empreendedor_end_rua' readonly value='".$db['empreendedor_end_rua']."' >
		</div>
		<div class='col-md-3'>
			<label for='empreendedor_end_numero'>N°:</label>
			<input type='text' class='form-control'  id='empreendedor_end_numero' name='empreendedor_end_numero' readonly value='".$db['empreendedor_end_numero']."' >
		</div>
		<div class='col-md-3'>
			<label for='empreendedor_end_complemento'>Complemento:</label>
			<input type='text' class='form-control'  id='empreendedor_end_complemento' name='empreendedor_end_complemento' readonly value='".$db['empreendedor_end_complemento']."' >
		</div>
	</div>
</div>
<div class='form-group'>
	<div class='row'>
		<div class='col-md-3'>
			<label for='empreendedor_end_bairro'>Bairro:</label>
			<input type='text' class='form-control'  id='empreendedor_end_bairro' name='empreendedor_end_bairro' readonly value='".$db['empreendedor_end_bairro']."' >
		</div>
		<div class='col-md-3'>
			<label for='empreendedor_end_cep'>CEP:</label>
			<input type='text' class='form-control'  id='empreendedor_end_cep' name='empreendedor_end_cep' maxlength='9' readonly value='".$db['empreendedor_end_cep']."' >
		</div>
		<div class='col-md-3'>
			<label for='empreendedor_end_cidade'>Cidade:</label>
			<input type='text' class='form-control'  id='empreendedor_end_cidade' name='empreendedor_end_cidade' readonly value='".$db['empreendedor_end_cidade']."' >
		</div>
		<div class='col-md-3'>
			<label for='empreendedor_end_estado'>Estado:</label>
			<select class='form-control'  name='empreendedor_end_estado' id='empreendedor_end_estado' readonly >
					<option value=NULL selected>". $lista_estados[ $db ['empreendedor_end_estado'] ] ."</option>
					
					</select>
		</div>
	</div>
</div>
<div class='form-group'>
	<div class='row'>
		<div class='col-md-6'>
			<label for='empreendedor_email'>Email:</label>
			<input type='email' class='form-control' id='empreendedor_email'  name='empreendedor_email' readonly value='".$db['empreendedor_email']."'>
		</div>
		<div class='col-md-6'>
			<label for='empreendedor_telefone'>Telefone:</label>
			<input type='text' class='form-control' maxlength='14' name='empreendedor_telefone' id='empreendedor_telefone' readonly value='".$db['empreendedor_telefone']."' >
		</div>
	</div>
</div> 

<legend class='uni-page-top'>2. Identificação do Empreendimento</legend>
	<div class='form-group'>
		<div class='row'>
			<div class='col-md-12'>
				<label for='emp_razaosocial'>Razão Social: </label>
				<input type='text' class='form-control' id='emp_razaosocial'  name='emp_razaosocial' readonly value='".$db['emp_razaosocial']."' >
			</div>
		</div>
	</div>
	<div class='form-group'>
		<div class='row'>
			<div class='col-md-6'>
				<label for='emp_fantasia'>Nome Fantasia: </label>
				<input type='text' class='form-control' id='emp_fantasia'  name='emp_fantasia' readonly value='".$db['emp_fantasia']."' >
			</div>
			<div class='col-md-6'>
				<label for='emp_cnpjcpf'>CNPJ/CPF:</label>
				<input type='text' class='form-control' maxlength='18' id='emp_cnpjcpf' name='emp_cnpjcpf' readonly value='".$db['emp_razaosocial']."' >
			</div>
		</div>
	</div>
	<div class='form-group'>
		<div class='row'>
			<div class='col-md-6'>
				<label for='emp_end_rua'>Endereço:</label>
				<input type='text' class='form-control' id='emp_end_rua'  name='emp_end_rua' readonly value='".$db['emp_end_rua']."' >
			</div>
			<div class='col-md-3'>
				<label for='emp_end_numero'>N°:</label>
				<input type='text' class='form-control' id='emp_end_numero'  name='emp_end_numero' readonly value='".$db['emp_end_numero']."' >
			</div>
			<div class='col-md-3'>
				<label for='emp_end_complemento'>Complemento:</label>
				<input type='text' class='form-control' id='emp_end_complemento'  name='emp_end_complemento' readonly value='".$db['emp_end_complemento']."' >
			</div>
		</div>
	</div>

	<div class='form-group'>
		<div class='row'>
			<div class='col-md-3'>
				<label for='emp_end_bairro'>Bairro:</label>
				<input type='text' class='form-control' id='emp_end_bairro'  name='emp_end_bairro' readonly value='".$db['emp_end_bairro']."' >
			</div>
			<div class='col-md-3'>
				<label for='emp_end_cep'>CEP:</label>
				<input type='text' class='form-control' id='emp_end_cep'  name='emp_end_cep' maxlength='9' readonly value='".$db['emp_end_cep']."' >
			</div>
			<div class='col-md-3'>
				<label for='emp_end_cidade'>Cidade:</label>
				<input type='text' class='form-control' id='emp_end_cidade'  name='emp_end_cidade' readonly value='".$db['emp_end_cidade']."' >
			</div>
			<div class='col-md-3'>
				<label for='emp_end_estado'>Estado:</label>
				<select class='form-control'  name='emp_end_estado' id='emp_end_estado' readonly>
					<option value=NULL selected>". $lista_estados[ $db ['emp_end_estado'] ] ."</option>
   			</select>
			</div>
		</div>
	</div>
<legend>3. Localização do Empreendimento</legend>
	<div class='form-group'>
		<div class='row'>
			<div class='col-md-6'>
				<label for='emp_status_coord'>Limite: </label>
				<input type='text' class='form-control' name='emp_status_coord' id='emp_status_coord' size='50' maxlength='50' readonly value='".$db['emp_status_coord']."' >
			</div>
			<div class='col-md-6'>
				<label for='emp_coord'>Coordenadas:</label>
				<input type='text' class='form-control' name='emp_coord' id='emp_coord' size='50' maxlength='50' readonly value='".$db['emp_coord']."' >
			</div>
		</div>
	</div>
<legend class='uni-page-top'>4. Atividade Licenciada</legend>
	<div class='form-group'>
	  <div class='row'>
		<div class='col-md-12' >
		  <label>Codigo da Atividade:</label>
		   <select id='atividade_cod' name='atividade_cod' class='form-control selectpicker' data-live-search='true' required='' tabindex='-98' readonly>
			 <option value='FALSE'>".$db['atividade_cod']."</option>
﻿
			</select>
		</div>
	  </div>
	</div>
	<div class='form-group'>
	  <div class='row'>
		<div class='col-md-3'>
		  <label>Tamanho:</label>
		  <input type='text' class='form-control'  id='atividade_tamanho' name='atividade_tamanho' readonly value='".$db['atividade_tamanho']."'>       
		</div>
		<div class='col-md-3'>
		  <label> Unidade de Medida</label>
		  <input type='text' class='form-control' id='atividade_auto_unid_medida' name='atividade_auto_unid_medida' value='".$db['atividade_auto_unid_medida']."' readonly>
		</div>
		<div class='col-md-3'>
		  <label>Potencial Poluidor</label>
		  <input type='text' class='form-control' id='atividade_auto_potencialpoluidor' name='atividade_auto_potencialpoluidor' readonly value='".$db['atividade_auto_potencialpoluidor']."'>
		</div>
		<div class='col-md-3'>
		  <label>Porte</label>
		  <input type='text' class='form-control'  id='atividade_auto_porte' name='atividade_auto_porte' readonly value='".$db['atividade_auto_porte']."' >
		</div>
	  </div>
	</div>                

	<div class='form-group'>
	  <div class='row'>
		<div class='col-md-6'>
		  <label for='tipoLicenca'>Tipo de Licença</label>
		  <select class='form-control' name='tipoLicenca' id='tipoLicenca' readonly>
			
				<option value=NULL selected>". $tipolicenca[ $db[ 'tipolicenca' ] ]."</option>
						
		  </select>
		</div>
		<div class='col-md-6'>
		  <label for='tipoLicenca'>Resolução</label>
		  <input type='text'  class='form-control' id='resolucao' name='resolucao' readonly value='".$db['resolucao']."'>
		</div>
	  </div>
	</div>
	<div class='form-group'>
	  <div class='row'>
			<div class='col-md-12'>
				<span><strong>Há responsável técnico pelo processo? 
				". ($db['emp_resp_tecnico'] ? ' <center>SIM</center>' : ' <center>NÃO</center>') ."
				</strong></span>
			</div>
	  </div>
	</div>";
	if($db['emp_resp_tecnico']){
		$quadrante1ao4 .= 
	"<div class='EmpreendResp' id='EmpreendResp'>
		<div class='form-group'>
			<div class='row'>
				<div class='col-md-4'>
					<label for='emp_resp_nome'> Nome: </label>
					<input type='text' class='form-control'  id='emp_resp_nome' name='emp_resp_nome' value='". $db['emp_resp_nome']."' disabled>
				</div>
				<div class='col-md-4'>
					<label for='emp_resp_regconselho'>Numero do Registro no Conselho:</label>
					<input type='text' class='form-control'  id='emp_resp_regconselho' name='emp_resp_regconselho' value='". $db['emp_resp_regconselho']."' disabled>
				</div>
				<div class='col-md-4'>
					<label for='emp_resp_registro'>Numero de ART ou Similar: </label>
					<input type='text' class='form-control'  id='emp_resp_registro' name='emp_resp_registro' value='". $db['emp_resp_registro']."' disabled>
				</div>
			</div>
		</div>
	</div>";
	}


	
$quadrante5 = "
<legend>5. Informações Sobre o Funcionamento</legend>
							<div class='form-group'>
								<span><strong>Atividade já iniciada?
									". ($db['atividade_iniciada'] ? ' <center>SIM</center>' : ' <center>NÃO</center>') ."
								</strong></span>
							</div>";
	if($db['atividade_iniciada']){
		$quadrante5 .=

							"<div class='atividade box' id='atividade'>
								<div class='form-group'>
								  <div class='row'>
								     <div class='col-md-4'>
								        <label>Data de Inicio da Atividade: </label>
								        <input type='text' class='form-control' id='atividade_dataini' name='atividade_dataini' value='".$db['atividade_dataini']."' disabled>
								     </div>
								  </div>
								</div>
								<div class='form-group'>
									<div class='row'>
										<div class='col-md-12'>
											<label><center>Horários de Expediente</center></label>
										</div>										
									</div>
									<div class='row'>		
										<div class='col-md-3'>
											<label>Inicio: </label>
											<input type='text' class='form-control' id='atividade_horainicio' maxlength='5' name='atividade_horainicio' value=' " .$db['atividade_horainicio'] . "' disabled>
										</div>
										<div class='col-md-3'>
											<label>Inicio do Intervalo: </label>
											<input type='text' class='form-control' id='atividade_horaintervalo' maxlength='5' name='atividade_horaintervalo' value='".$db['atividade_horaintervalo']."' disabled>
										</div>
										<div class='col-md-3'>
											<label>Fim do Intervalo: </label>
											<input type='text' class='form-control' id='atividade_horaintervalofim' maxlength='5' name='atividade_horaintervalofim' value='".$db['atividade_horaintervalofim']."' disabled>
										</div>	
										<div class='col-md-3'>
											<label>Encerramento: </label>
											<input type='text' class='form-control' id='atividade_horaencerramento' maxlength='5' name='atividade_horaencerramento' value='".$db['atividade_horaencerramento']."' disabled>
										</div>						  
										
									</div>
								</div>
								<div class='form-group'>
									<div class='row'>
										<div class='col-md-12'>
											<label>Dias de funcionamento na semana: </label>
											<br>
											<label class='checkbox-inline'>
												<input type='checkbox' id='atividade_seg' name='atividade_seg' ". ($db['atividade_seg'] ? ' checked' : '') ." disabled>Segunda-Feira</label>
											<label class='checkbox-inline'>
												<input type='checkbox' id='atividade_ter' name='atividade_ter' ". ($db['atividade_ter'] ? ' checked' : '') ." disabled>Terça-Feira</label>
											<label class='checkbox-inline'>
												<input type='checkbox' id='atividade_qua' name='atividade_qua' ". ($db['atividade_qua'] ? ' checked' : '') ." disabled>Quarta-Feira</label>
											<label class='checkbox-inline'>
												<input type='checkbox' id='atividade_qui' name='atividade_qui' ". ($db['atividade_qui'] ? ' checked' : '') ." disabled>Quinta-Feira</label>
											<label class='checkbox-inline'>
												<input type='checkbox' id='atividade_sex' name='atividade_sex' ". ($db['atividade_sex'] ? ' checked' : '') ." disabled>Sexta-Feira</label>
											<label class='checkbox-inline'>
												<input type='checkbox' id='atividade_sab' name='atividade_sab' ". ($db['atividade_sab'] ? ' checked' : '') ." disabled>Sábado</label>
											<label class='checkbox-inline'>
												<input type='checkbox' id='atividade_dom' name='atividade_dom' ". ($db['atividade_dom'] ? ' checked' : '') ." disabled>Domingo</label>
										</div>
									</div>
								</div>
							</div>";
	}

$quadrante6 ="<legend>6. Informações Sobre o Consumo de Água</legend>
	<div class='form-group'>
		<span><strong>Há consumo de água no empreendimento?</strong></span>
			". ($db['agua_consumo'] ? ' <center>SIM</center>' : ' <center>NÃO</center>') ."
		</strong></span>
	</div>";
	if($db['agua_consumo']){
		$quadrante6 .=	"<div class='consumoAgua box' id='consumoAgua'>
			<div class='form-group'>
				<div class='row'>
					<div class='col-md-12'>
						<label>Forma de Abastecimento: </label>
						<label class='checkbox-inline'>
							<input type='checkbox' id='agua_redepublica' name='agua_redepublica' ". ($db['agua_redepublica'] ? ' checked' : '') ." disabled>Rede Pública</label>
						<label class='checkbox-inline'>
							<input type='checkbox' id='agua_rioouarroio' name='agua_rioouarroio' ". ($db['agua_rioouarroio'] ? ' checked' : '') ." disabled>Rios ou Arroios</label>
						<label class='checkbox-inline'>
							<input type='checkbox' id='agua_poco' name='agua_poco' ". ($db['agua_poco'] ? ' checked' : '') ." disabled>Poço</label>
						<label class='checkbox-inline'>
							<input type='checkbox' id='agua_outro' class='ative' name='agua_outro' ". ($db['agua_outro'] ? ' checked' : '') ." disabled> Outro
						</label>
					</div>
				</div>
			</div>
			<div id='opYes' >
				<div class='form-group'>
					<div class='row'>
						<div class='col-md-12'> 
							<label> Especificar:</label>
							<textarea class='form-control' id='agua_outro_especificar' name='agua_outro_especificar' readonly placeholder='Especificar tipo de tratamento'>" . $db['agua_outro_especificar'] . "</textarea>
						</div>
					</div>
				</div>
			</div>
			</div>";
	}
$quadrante7 ="<legend>7. Relação dos equipamentos utilizados no empreendimento</legend>
	<div class='form-group'>
		<span><strong>Há utilização de equipamentos no empreendimento? </strong></span>
			". ($db['equipamentos_utilizacao'] ? ' <center>SIM</center>' : ' <center>NÃO</center>') ."
		</strong></span>
	</div>";
	if($db['equipamentos_utilizacao']){
	$quadrante7 .= "<div class='equipEmp box' id='empEquipI'>
		<div class='table-responsive'>
			<div class='form-group'>
				<table class='table table-bordered table-hover'  id='tab_logico'>
					<thead>
						<tr>
							<th class='text-center'>
								#
							</th>
							<th class='text-center'>
								Equipamentos
							</th>
							<th class='text-center'>
								Descrição
							</th>
							<th class='text-center'>
								Quantidade
							</th>
						</tr>
					</thead>
					<tbody>
						<tr id='addro0'>
							<td>
								1
							</td>
							<td>
								<input type='text' name='equipNome[]' id='equipNome[]' class='form-control' disabled>
							</td>
							<td>
								<input type='text' name='equipDescricao[]' id='equipDescricao[]' class='form-control' disabled>
							</td>
							<td>
								<input type='text' name='equipQuantidade[]' id='equipQuantidade[]'  class='form-control' disabled>
							</td>
						</tr>
						<tr id='addro1'></tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>";
}

$quadrante8 ="<legend>8. Relação de produção do empreendimento</legend>
	<div class='form-group'>
		<span><strong>Há processo produtivo no empreendimento? </strong></span>
		<div class='onoffswitch'>
			<input type='checkbox' name='producao_processo' class='onoffswitch-checkbox' id='producao_processo' value=TRUE>
			<label class='onoffswitch-label' for='producao_processo'>
				<span class='onoffswitch-inner'></span>
				<span class='onoffswitch-switch'></span>
			</label>
		</div>
	</div>
	<div class='equipTab box' id='empTabI'>
			<div class='table-responsive'>
				<div class='form-group'>
					<table class='table table-bordered table-hover'  id='tab_logica'>
						<thead>
							<tr>
								<th class='text-center'>
									#
								</th>
								<th class='text-center'>
									Produto Final
								</th>
								<th class='text-center'>
									Quantidade Produzida/Mês
								</th>
								<th class='text-center'>
									Forma de Acondicionamento
								</th>
							</tr>
						</thead>
						<tbody>
							<tr id='addrow0'>
								<td>
									1
								</td>
								<td>
									<input type='text' name='prodNome[]' id='prodNome[]'  class='form-control' disabled>
								</td>
								<td>
									<input type='text' name='prodQuantidade[]' id='prodQuantidade[]'  class='form-control' disabled>
								</td>
								<td>
									<input type='text' name='prodAcondicionamento[]' id='prodAcondicionamento[]'  class='form-control' disabled>
								</td>
							</tr>
						<tr id='addrow1'></tr>
					</tbody>
				</table>
			</div>
		</div>
		<a id='add_row3' style='margin-right:5px;' class='btn btn-primary'>+</a><a id='delete_row3' class='btn btn-danger'>-</a>
										<br>
		<br>
		<br>
		<br>
		<span><strong>Descreva as etapas do processo produtivo industrial, desde a entrada da matéria-prima até a saída do produto final, incluindo as principais informações de cada etapa.</strong></span>
		<div class='form-group'>
			<textarea placeholder='Descrição...' class='form-control'  rows='5' name='producao_descricao' id='producao_descricao' disabled></textarea>
		</div>
	</div>";
$quadrante9 ="<legend>9. Efluentes Líquidos Sanitários</legend>
	<div class='form-group'>
		<span><strong>Há geração de Efluentes Sanitários no empreendimento? </strong></span>
		<div class='onoffswitch'>
			<input type='checkbox' name='sanitarios_geracao' class='onoffswitch-checkbox' id='sanitarios_geracao' value=TRUE>
			<label class='onoffswitch-label' for='sanitarios_geracao'>
				<span class='onoffswitch-inner'></span>
				<span class='onoffswitch-switch'></span>
			</label>
		</div>
	</div>
	<div class='efluSan box' id='efluSanI'>
		<div class='form-group'>
			<div class='row'>
				<div class='col-md-12'>
					<span><strong> Tipo de Tratamento dos Efluentes Sanitários:</strong></span>
					<label class='checkbox-inline'>
						<input type='checkbox' id='sanitarios_tipo_sistema_publico'  name='sanitarios_tipo_sistema_publico' value='true'>Rede Pública Coletora</label>
					<label class='checkbox-inline'>
						<input type='checkbox' id='sanitarios_tipo_nao_possui'  name='sanitarios_tipo_nao_possui' value='true'>Não possui sistema de tratamento</label>
					<label class='checkbox-inline'>
						<input type='checkbox' value='true'  id='sanitarios_tipo_sistema_proprio' class='ownSist' name='sanitarios_tipo_sistema_proprio'>Sistema de tratamento próprio
					</label>
				</div>
			</div>
		</div>
	<div id='mostra'>
		<div class='form-group'>
			<div class='row'>
				<div class='col-md-12'>
					<label> Especificar:</label>
						<textarea placeholder='Especificar tratamento'  class='form-control' id='sanitarios_sistema_proprio_esp' name='sanitarios_sistema_proprio_esp' rows='5' disabled></textarea>
					</div>
				</div>
			</div>
		</div>
					
		<div class='form-group'>
			<span><strong>Disposição Final dos Efluentes Sanitários: </strong></span>
			<input name='sanitarios_disposicao_final'  id='sanitarios_disposicao_final' value='true' type='radio'> Infiltração no Solo e ou Sumidouro
			<space></space>
			<input name='sanitarios_disposicao_final'  id='sanitarios_disposicao_final' value='true' type='radio'> Corpo hidrico superficial
			<space></space>
			<input name='sanitarios_disposicao_final'  id='sanitarios_disposicao_final' value='true' type='radio'> Sistema de Drenagem Pluvial
			<space></space>
			<input name='sanitarios_disposicao_final'  id='sanitarios_disposicao_final' value='true' type='radio'>Rede Publica Coletora
		</div>
		<br>
					
		<div class='form-group'>
			<span><strong>Reaproveitamento dos Efluentes Sanitários:  </strong></span>
			<input name='sanitarios_reaproveita'  id='sanitarios_reaproveita' value='total' type='radio'> Total
			<space></space>
			<input name='sanitarios_reaproveita'  id='sanitarios_reaproveita' value='parcial' type='radio'> Parcial
			<space></space>
			<input name='sanitarios_reaproveita'  id='sanitarios_reaproveita' value='nao' type='radio'> Não há reaproveitamento
			<space></space>
		</div>
					
		<div class='opcao box' id='opcaoI'>
			<div class='col-md-12 '>
				<label> Especificar Reaproveitamento dos Efluentes Sanitários: </label>
				<textarea placeholder='Especificar reaproveitamento'  class='form-control' id='sanitarios_reaproveita_esp' name='sanitarios_reaproveita_esp' rows='5' disabled></textarea>
			</div>
		</div>
	</div>	";
$quadrante10 ="<legend>10. Efluentes Líquidos Industriais
	</legend>
	<div class='form-group'>
		<span><strong>Há gração de Efluentes Líquidos Industriais no empreendimento? </strong></span>
		<div class='onoffswitch'>
			<input type='checkbox' name='liquidos_geracao' class='onoffswitch-checkbox' id='liquidos_geracao' value=TRUE>
			<label class='onoffswitch-label' for='liquidos_geracao'>
				<span class='onoffswitch-inner'></span>
				<span class='onoffswitch-switch'></span>
			</label>
		</div>
	</div>
	<div class='efluIndust box' id='efluIndustI'>
		<div class='form-group'>
			<div class='row'>
				<div class='col-md-12'>
					<label> Especificar tipo de tratamento dos Efluentes Líquidos Industriais:</label>
					<textarea placeholder='Especificar tipo de tratamento ' class='form-control ' id='liquidos_gerecao_esp' name='liquidos_gerecao_esp' rows='5' disabled></textarea>
				</div>
			</div>
		</div>
		<div class='form-group'>
			<div class='row'>
				<div class='col-md-12'>
					<label> Em qual etapa? </label>
						<label class='checkbox-inline'>
							<input type='checkbox' id='liquidos_geracao_processo_prod'  name='liquidos_geracao_processo_prod' value='true'>Processo de produção</label>
						<label class='checkbox-inline'>
							<input type='checkbox' id='liquidos_geracao_refrigeracao'  name='liquidos_geracao_refrigeracao' value='true'>Refrigeração</label>
						<label class='checkbox-inline'>
							<input type='checkbox' id='liquidos_geracao_lavagem' name='liquidos_geracao_lavagem'  value='true'>Lavagem de pisos e equipamentos</label>
						<label class='checkbox-inline'>
							<input type='checkbox' id='liquidos_geracao_lavag_veiculos' name='liquidos_geracao_lavag_veiculos'  value='true'>Lavagem de veículos</label>
						<label class='checkbox-inline'>
							<input type='checkbox' value='true' id='liquidos_geracao_outros' class='liquidos_geracao_outros' name='liquidos_geracao_outros'  >Outros
						</label>
				</div>
			</div>
		</div>			
		<div id='etapa'>
			<div class='form-group'>
				<div class='row'>
					<div class='col-md-12 '>
						<label> Especificar etapa de geração dos Efluentes Líquidos Industriais: </label>
						<textarea placeholder='Especificar etapa de geração'  class='form-control' id='liquidos_geracao_outros_esp' name='liquidos_geracao_outros_esp' rows='5' disabled></textarea>
					</div>
				</div>
			</div>									
		</div>
		<span><strong>Disposição Final dos Efluentes Líquidos Industriais</strong></span>
			<div class='form-group'>
				<div class='row'>
					<div class='col-md-12'>
						<span><strong>Disposição Final dos Efluentes Líquidos Industriais:  </strong></span>
							<input name='liquidos_disposicao' id='liquidos_disposicao'  value='true' type='radio' /> Infiltração no Solo ou Sumidouro
						<space></space>
							<input name='liquidos_disposicao' id='liquidos_disposicao'  value='true' type='radio'> Corpo hidrico superficial
						<space></space>
							<input name='liquidos_disposicao' id='liquidos_disposicao'  value='true' type='radio'> Sistema de Drenagem Pluvial
						<space></space>
							<input name='liquidos_disposicao' id='liquidos_disposicao'  value='true' type='radio'>Rede Publica Coletora
					</div>
				</div>
			</div>
			
			<div class='form-group'>
				<span><strong>Reaproveitamento dos Efluentes Líquidos Industriais:  </strong></span>
					<input name='liquidos_reaproveita'  id='liquidos_reaproveita' value='total' type='radio'> Total
				<space></space>
					<input name='liquidos_reaproveita'  id='liquidos_reaproveita' value='parcial' type='radio'> Parcial
				<space></space>
					<input name='liquidos_reaproveita'  id='liquidos_reaproveita' value='nao' type='radio'> Não há reaproveitamento
				<space></space>
			</div>
			
			<div class='indstrialShow box' id='indstrialShowX'>
				<div class='form-group'>
					<div class='row'>
						<div class='col-md-12'>
							<label> Especificar Reaproveitamento dos Efluentes Industriais: </label>
							<textarea placeholder='Especificar modo de reaproveitamento...'  class='form-control' id='liquidos_reaproveita_esp' name='liquidos_reaproveita_esp' rows='5' disabled></textarea>
						</div>
					</div>
				</div>
			</div>
	</div>";
$quadrante11 ="<legend>11. Emissões Sonoras e Atmosféricas</legend>
	<div class='form-group'>
		<span><strong>Há geração de Emissões Sonoras ou Atmosféricas no empreendimento? </strong></span>
		<div class='onoffswitch'>
			<input type='checkbox' name='atm_geracao' class='onoffswitch-checkbox' id='atm_geracao' value=TRUE>
			<label class='onoffswitch-label' for='atm_geracao'>
				<span class='onoffswitch-inner'></span>
				<span class='onoffswitch-switch'></span>
			</label>
		</div>
	</div>		
	<div id='atmosSons' class='atmos box'>
		<div class='form-group'>
			<div class='row'>
				<div class='col-md-12'>
					<label>Descrição das fontes geradoras e dos mecanismos de controle: </label>
					<textarea placeholder='Descrição...' class='form-control'  id='atm_geracao_esp' name='atm_geracao_esp' rows='5' disabled></textarea>
				</div>
			</div>
		</div>
	</div>";
$quadrante12 ="<legend>12. Residuos Sólidos</legend>
	<div class='form-group'>
		<span><strong>Há geração de Residuos Sólidos no empreendimento? </strong></span>
		<div class='onoffswitch'>
			<input type='checkbox' name='solidos_geracao' class='onoffswitch-checkbox' id='solidos_geracao' value=TRUE>
			<label class='onoffswitch-label' for='solidos_geracao'>
				<span class='onoffswitch-inner'></span>
				<span class='onoffswitch-switch'></span>
			</label>
		</div>
	</div>
	<div id='residuos' class='resi box'>
		<div class='form-group'>
			<div class='row'>
				<div class='col-md-12'>
					<label>Descrição(tipo, acondicionamento, destinação final, entre outros): </label>
					<textarea placeholder='Descrição...' class='form-control' id='solidos_geracao_esp'  name='solidos_geracao_esp' rows='5' disabled></textarea>
				</div>
			</div>
		</div>
	</div>";
$quadrante13 ="<legend>13. Vegetação</legend>
	<div class='form-group'>
		<span><strong>O empreendimento necessita intervir na vegetação? </strong></span>
		<div class='onoffswitch'>
			<input type='checkbox' name='vegetacao_intervencao' class='onoffswitch-checkbox' id='vegetacao_intervencao' value=TRUE>
			<label class='onoffswitch-label' for='vegetacao_intervencao'>
				<span class='onoffswitch-inner'></span>
				<span class='onoffswitch-switch'></span>
			</label>
		</div>
	</div>

	<div id='vegetacaoI' class='vegetacao box'>
		<div class='form-group'>
			<div class='row'>
				<div class='col-md-5'>
					<span><strong>Em qual o tipo de vegetação?</strong></span>
				</div>
			</div>
		</div>
		<div class='form-group'>
			<div class='row'>
				<div class='col-md-2'>
					<input value='true' id='nativa' class='nativa' name='nativa'  type='checkbox'> Nativa
				</div>
				<div id='opNativa'>
					<div class='col-md-10'>
					<span><strong>Tipo de intervenção:</strong></span>
						<input value='true' name='nativa_supressao' id='nativa_supressao'  type='checkbox'> Supressão
						<input value='true' id='nativa_transplante' name='nativa_transplante'  type='checkbox'> Transplante
						<input value='true' id='nativa_poda' name='nativa_poda' type='checkbox'  > Poda
						<input value='true' name='nativa_descap' id='nativa_descap'  type='checkbox'> Descapoeiramento
						<input value='true' name='nativa_decapagem' id='nativa_decapagem' type='checkbox'  > Decapagem
					</div>
				</div>
			</div>
		</div>
		
		<div class='form-group'>
			<div class='row'>
				<div class='col-md-2'>
					<input value='true' id='exotica' name='exotica' class='exotica'  type='checkbox'> Exótica
				</div>
				<div id='opexotica'>
					<div class='col-md-10'>
						<span><strong>Tipo de intervenção:</strong></span>
						<input value='true' name='exotica_supressao' id='exotica_supressao'  type='checkbox'> Supressão
						<input value='true' id='exotica_transplante' name='exotica_transplante'  type='checkbox'> Transplante
						<input value='true' id='exotica_poda' name='exotica_poda' type='checkbox'  > Poda
						<input value='true' name='exotica_descap' id='exotica_descap'  type='checkbox'> Descapoeiramento
						<input value='true' name='exotica_decapagem' id='exotica_decapagem' type='checkbox'> Decapagem
					</div>
				</div>
			</div>
		</div>
		
	</div>";
	
$conteudoBody = $quadrante1ao4 . $quadrante5 . $quadrante6 . $quadrante7;
// $conteudoBody = $quadrante1ao4 . $quadrante5 . $quadrante6 . $quadrante7 . $quadrante8 . $quadrante9 . $quadrante10 . $quadrante11 . $quadrante12 . $quadrante13;

$rodape = "<p><button class='btn btn-info btn-lg' onclick='window.print()'>IMPRIMIR</button></p>
						<p>Formulário Dinâmico</p>";

// FIM TRATAMENTO DAS VARIÁVEIS

$modReturn ="
		<html>
		
			<div id='conteudo'>
				<section class='col-sm-12 col-lg-12 col-md-12 col-xs-12 table-responsive connectedSortable ui-sortable' id='mod'>
					<div class='box box-success' id='box'>
						<div id='box-header' class='box-header with-border'>
						<h3 id='box-title' class='box-title'>" . 
						
						utf8_decode($conteudoHeader)
						
						. "</h3>
						<div id='box-tools' class='box-tools pull-right'>
							<span id='label' class='label label-primary'></span>
						</div>
						
						</div>
						<div id='box-body' class='box-body'>".
						
						utf8_decode($conteudoBody)
						
						."</div>
						<div id='box-footer' class='box-footer'>".
						
						utf8_decode($rodape)
						
						."</div>
					</div>
				</section>
			</div>		
		
		</html>
			";
		echo $modReturn;
?>