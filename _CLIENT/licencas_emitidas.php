<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('default_charset','UTF-8');

$lista_licencas = $this->execQuery('SELECT * FROM uni__licam_licencas WHERE razao_social != ""')['result'];
$conteudo ="";
foreach ($lista_licencas as $key => $value){
	$conteudo.="
	<tr>
		<td><i class='fa fa-arrow-right' aria-hidden='true'><a class='abrir' href='arquivos/licencas/".str_replace("/","-",$lista_licencas[$key]['numero_processo']).".pdf' 	target='_blank'>".$lista_licencas[$key]['numero_processo']." - ".$lista_licencas[$key]['razao_social']."</a></i>
		</td>
	</tr>";
}

$return_string ="
	<table class='table table-striped termos'>
		<tbody>
			$conteudo
		</tbody>
	</table>";	
echo $return_string;
?>
	
    