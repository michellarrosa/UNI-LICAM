<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('default_charset','UTF-8');

// TRATAMENTO DAS VARIÁVEIS

$conteudoHeader = "MONTA INICIO çç";
$conteudoBody = "";
$rodape = "rodape estilo com variável";

// FIM TRATAMENTO DAS VARIÁVEIS

$modReturn ="
		<html>
		
			<div id='conteudo'>
				<div class='col-md-3 col-sm-6 col-xs-12'>
					<div class='info-box bg-aqua'>
						<span class='info-box-icon'><i class='fa fa-bookmark'></i></span>
						<div class='info-box-content'>
							<span class='info-box-text'>Novos Processos</span>
							<span class='info-box-number'>54</span>
							<!-- The progress section is optional -->
							<div class='progress'>
								<div class='progress-bar' style='width: 70%'></div>
							</div>
							<span class='progress-description'>
								70% + em 30 Dias
							</span>
						</div><!-- /.info-box-content -->
					</div>
					<div class='box'>
						<a href='./?menu=3' class='btn btn-info btn-lg btn-block' role='button'>Novos Processos</a>
					</div>
				</div>
				<div class='col-md-3 col-sm-6 col-xs-12'>
					<div class='info-box bg-green'>
						<span class='info-box-icon'><i class='fa fa-thumbs-o-up'></i></span>
						<div class='info-box-content'>
							<span class='info-box-text'>Processos Pagos</span>
							<span class='info-box-number'>41</span>
							<!-- The progress section is optional -->
							<div class='progress'>
								<div class='progress-bar' style='width: 30%'></div>
							</div>
							<span class='progress-description'>
								30% + em 30 Dias
							</span>
						</div><!-- /.info-box-content -->
					</div>
					<div class='box'>
						<a href='./?menu=3' class='btn btn-success btn-lg btn-block' role='button'>Processos Pagos</a>
					</div>
				</div>
				<div class='col-md-3 col-sm-6 col-xs-12'>
					<div class='info-box bg-yellow'>
						<span class='info-box-icon'><i class='fa fa-calendar'></i></span>
						<div class='info-box-content'>
							<span class='info-box-text'>Tramitando</span>
							<span class='info-box-number'>211</span>
							<!-- The progress section is optional -->
							<div class='progress'>
								<div class='progress-bar' style='width: 20%'></div>
							</div>
							<span class='progress-description'>
								20% + em 30 Dias
							</span>
						</div><!-- /.info-box-content -->
					</div>
					<div class='box'>
						<a href='./?menu=3' class='btn btn-warning btn-lg btn-block' role='button'>Tramitando</a>
					</div>
				</div>
				<div class='col-md-3 col-sm-6 col-xs-12'>
					
					<div class='info-box bg-red'>
						
						<span class='info-box-icon'><i class='fa fa-comments-o'></i></span>
						
						<div class='info-box-content'>
							<span class='info-box-text'>Processos em Geral</span>
							<span class='info-box-number'>41,410</span>
							<!-- The progress section is optional -->
							<div class='progress'>
								<div class='progress-bar' style='width: 50%'></div>
							</div>
							<span class='progress-description'>
								50% + em 30 Dias
							</span>
						</div><!-- /.info-box-content -->
					</div>
					<div class='box'>
						<a href='./?menu=3' class='btn btn-danger btn-lg btn-block' role='button'>Geral</a>
					</div>
				</div>
			</div>		
		
		</html>
			";
		echo utf8_decode($modReturn);
?>