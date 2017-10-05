<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('default_charset','UTF-8');

session_start();
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

	$query = "SELECT id FROM uni__xlicam_empreendimentodata WHERE responsavel_cpf='".$_SESSION['uni_ext_cpf']."' ORDER BY id";
	$formularios = $this->execQuery($query)['result'];
	unset($_SESSION['licenciamentos']);
	foreach($formularios as $value){
		$_SESSION['licenciamentos'][] = $value['id'];					
	}



if(!isset($_SESSION['uni_ext_login']) ) {
	header("Location:login.php");
}
$date = new \DateTime();
$datetimeFormat = 'm/d/Y';

$listadeprocessos = $this->execQuery("SELECT * FROM uni__xlicam_empreendimentodata WHERE responsavel_cpf = '". $_SESSION['uni_ext_cpf']."'ORDER BY id")['result'];
$conteudoBody="";
	foreach($listadeprocessos as $key=>$value){
		
		if(is_null($value['time_edicao'])){
			$value['time_edicao'] = $value['time_criacao'];
		}
		$timestamp = strtotime(date('d-m-Y', strtotime($value['time_criacao'])));
		$date->setTimestamp($timestamp);
		
		$conteudoBody.="<tr>					
							<td><center>".$value['emp_razaosocial']."</center></td>
							<td><center>".strftime('%d de %B de %Y ',strtotime($date->format($datetimeFormat)))."</center></td>
							<td><center>Aguardando Pagamento</center></td>
							<td><center>Ainda não gerado</center></td>
							<td class='text-center'><button type='button' id='".$value['emp_razaosocial']."'class='btn btn-default' onclick=imprime_formulario('imprimir.php?cod=".$key."');>Imprimir <i class='fa fa-print'</i></button></td>
							<td class='text-center'><button type='button' id='".$value['emp_razaosocial']."'class='btn btn-default' onclick=location.href='editavel.php?cod=".$key."';>Editar <i class='fa fa-pencil-square-o'</i></button></td>
														
						</tr>";
	}


$modReturn ="
	<div class='form-group'>
		<div class='row'>
			<div class='col-md-12'>
			<br><br>
					<div class='panel panel-success'>
						<div class='panel-heading panel-cabecalho'>Usuário: ".$_SESSION['uni_ext_username']."</div>
					<div class='panel-body panel-corpo'>
						<center><h2>Minhas Solicitações</h2></center><br>
						<div class='table-responsive'>
							<table id='solicitacoes' class='table table-hover table-striped'>
								<thead>
			      					<tr>
			      						<th class=' col-md-3 text-center' >Razão social</th>
					                 	<th class='text-center' >Ultima modificação</th>
									  	<th class='text-center' >Status</th>
									  	<th class='text-center' >N° do processo</th>
									  	<th class='text-center' >Impressão</th>
									  	<th class='text-center' >Editar formulário</th>
										
									  	<!-- <th></th> -->
									</tr>
								</thead>
								<tbody>
									$conteudoBody
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
";
echo $modReturn;




?>
	
    