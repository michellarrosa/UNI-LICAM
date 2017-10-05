<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('default_charset','UTF-8');

// TRATAMENTO DAS VARIÁVEIS

$conteudoHeader = "Gráficos & Demonstrativos";
$conteudoBody = "Aqui você encontra vários demonstrativos das atividades dos últimos meses.<br>Selecione Novos Processos para visualisar a lista de processos recém emitidos e escolher um para começar a trabalhar.<br>Por hora será permitida a impressão; porém, num futuro próximo, todo o tramite de licenciamento, fiscalização e emissão de documentos será feito via sistema.";
$rodape = "click-veja";

// FIM TRATAMENTO DAS VARIÁVEIS

$modReturn ="
		<html>
		
			<div id='conteudo'>
				<section class='col-lg-6 col-md-6 connectedSortable ui-sortable' id='mod'>
					<div class='box box-success' id='box'>
						<div id='box-header' class='box-header with-border'>
						<h3 id='box-title' class='box-title'>" . 
						
						htmlentities($conteudoHeader)
						
						. "</h3>
						<div id='box-tools' class='box-tools pull-right'>
							<span id='label' class='label label-primary'></span>
						</div>
						
						</div>
						<div id='box-body' class='box-body'>".
						
						utf8_decode($conteudoBody)
						
						."</div>
						<div id='box-footer' class='box-footer'>".
						
						htmlentities($rodape)
						
						."</div>
					</div>
				</section>
			</div>		
		
		</html>
			";
		echo $modReturn;
?>