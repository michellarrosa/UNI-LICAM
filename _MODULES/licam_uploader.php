<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('default_charset','UTF-8');
//VARIÁVEIS INICIAIS
$warning;
$conteudoHeader="";
$conteudoBody="";
$rodape="";

//PROCESSAMENTO CARREGADO

$nome_do_arquivo='sigma_doc_for_licam';
$local_armazenar='logs/';
$novo_nome_arquivo='';
$extensoes_ok=array("pdf");

if( isset($_POST['doc_submit']) && isset($_FILES['sigma_doc_for_licam']) ){
    
    $up = $this->uniFileUploader($nome_do_arquivo,$extensoes_ok, $local_armazenar, $novo_nome_arquivo);
	$warning = $up;
}


// TRATAMENTO DAS VARIÁVEIS



// TRATAMENTO DAS VARIÁVEIS PRINCIPAIS
$warning = 	(	empty($warning)? "":
				"<div class='callout callout-info'>
					<h4>Informação!</h4>
						". $warning ."
					<br><a href='./'>Analise a documentação</a>
				</div>"
			);
$conteudoHeader = "Alteração de senhas de usuários";
$conteudoBody="
	<form method='post' enctype='multipart/form-data' action=# id='envia_licam_doc'>
        <input type='file' id='sigma_doc_for_licam' name='sigma_doc_for_licam' multiple>
</form>";
	
$rodape = "	<button type='reset' class='btn btn-default'>
                Cancelar
            </button>
            <button type='submit' id='doc_submit' name='doc_submit' form='envia_licam_doc' class='btn btn-info pull-right'>
                Enviar
            </button>";

// FIM TRATAMENTO DAS VARIÁVEIS

$modReturn ="
	<html>
		<div id='conteudo'>
			<section class='col-sm-12 col-lg-12 col-md-12 col-xs-12 table-responsive connectedSortable ui-sortable' id='mod'>
					". $warning ."
					<div class='box box-success' id='box'>
						<div id='box-header' class='box-header with-border'>
						<h3 id='box-title' class='box-title'>" . 
						
						$conteudoHeader
						
						. "</h3>
						<div id='box-tools' class='box-tools pull-right'>
							<span id='label' class='label label-primary'></span>
						</div>
						
						</div>
						<div id='box-body' class='box-body'>".
						
						$conteudoBody
						
						."</div>
						<div id='box-footer' class='box-footer'>".
						
						$rodape
						
						."</div>
					</div>
				</section>
		</div><!-- /#conteudo -->
	</html>
			";
echo utf8_decode($modReturn);
?>