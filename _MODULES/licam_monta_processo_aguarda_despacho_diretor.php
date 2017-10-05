<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('default_charset','UTF-8');

// TRATAMENTO DAS VARIÁVEIS

$tituloModulo = "Processos Aguardando Despacho";
$conteudoBody = "";
$rodape = "rodape estilo com variável";

$listadeprocessos = $this->execQuery("SELECT * FROM com_licam.empreendimentodata")[result];

foreach($listadeprocessos as $key=>$value){
	$conteudoBody.="<tr>
								<td>".$value['id']."</td>
								<td>".$value['responsavel_cpf']."</td>
								<td>".$value['empreendedor_cnpjcpf']."</td>
								<td>".$value['tipolicenca']."</td>
								<td>".$value['atividade_cod']."</td>
							</tr>";
}

// FIM TRATAMENTO DAS VARIÁVEIS

$modReturn ="
		<html>
			<div id='conteudo'>
			
				<div class='col-xs-12'>
          <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>".$tituloModulo."</h3>
            </div>
            <!-- /.box-header -->
            <div class='box-body'>
              <table id='example2' class='table table-bordered table-hover'>
                <thead>
                <tr>
                  <th>Protocolo</th>
                  <th>CPF requerente</th>
                  <th>CNPJ Requerido</th>
                  <th>Tipo Licença</th>
                  <th>Cód. Atividade</th>
                </tr>
                </thead>
								
                <tbody>
								
                ".$conteudoBody."
								
								</tbody>
								
                <tfoot>
                <tr>
                  <th>Protocolo</th>
                  <th>CPF requerente</th>
                  <th>CNPJ Requerido</th>
                  <th>Tipo Licença</th>
                  <th>Cód. Atividade</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

				</div>
				
			</div><!-- /#conteudo -->
		</html>
			";
		echo utf8_decode($modReturn);
?>
