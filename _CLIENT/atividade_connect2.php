<?php

	$q = $_POST['dados']; //pego o numero que o user digitou
	if($q > 0){
			$q = $_POST['dados']; //tamanho
			$valor = $_POST['valor']; // select
			$potencial = $_POST['potencial']; //potencial
			
			$sql="SELECT minimo_inferior, minimo_superior, pequeno_inferior, pequeno_superior, medio_inferior, medio_superior, grande_inferior, grande_superior, ex_inferior, ex_superior FROM com_licam.atividades_tabela WHERE id = '".$valor."'";
			$result = $this->execQuery($sql)['result'];
			// $row = $result[0]['minimo_superior'];
			// $row2 = $result[0]['minimo_inferior'];
			$min_sup =(float) $result[0]['minimo_superior'];
			$min_inf = (float)$result[0]['minimo_inferior'];
			$peq_sup = (float)$result[0]['pequeno_superior'];
			$peq_inf = (float)$result[0]['pequeno_inferior'];
			$med_sup = (float)$result[0]['medio_superior'];
			$med_inf= (float)$result[0]['medio_inferior']; 
			$gran_sup = (float)$result[0]['grande_superior'];
			$gran_inf =(float) $result[0]['grande_inferior'];
			$ex_sup = (float)$result[0]['ex_superior'];
			$ex_inf =(float) $result[0]['ex_inferior'];
			$size=strlen($q);
			if(($size==8)||($size==9)||($size==10)||($size==12)){
				$q= str_replace(".","",$q);
				$q= str_replace(",",".",$q);
			
			}else{
				$q= str_replace(",",".",$q);
			}			
			
			$q = (float)$q;
			if( $q < $min_inf ){
				$row="Não Licenciável";
			}elseif( ( ($q >= $min_inf)&&($q<= $min_sup) ) && (($min_inf != -1)&&($min_sup != -1) )){
				$row="Mínimo";
			}elseif( ( ($q >= $peq_inf)&&($q<= $peq_sup) ) && (($peq_inf != -1)&&($peq_sup != -1)) ){
				$row="Pequeno";					
			}elseif( ( ($q >= $med_inf)&&($q<= $med_sup) ) && (($med_inf != -1)&&($med_sup != -1)) ){
				$row="Médio";
			}elseif( ( ($q >= $gran_inf)&&($q<= $gran_sup) ) && (($gran_inf != -1)&&($gran_sup != -1)) ){
				$row="Grande";
			}elseif( ( ($q >= $ex_inf)&&($q<= $ex_sup) ) && (($ex_inf != -1)&&($ex_sup != -1)) ){
				$row="Excepcional";
			}else{
				$row="Licenciável pela FEPAM";
			}
			

			if(!strcmp('Medio ',$potencial)){
				if(!strcmp('Pequeno',$row)){
					$row = $row.",LUR,LU";
				}elseif(!strcmp('Mínimo',$row)){
					$row = $row.",LUR,LU";
				}else{
					$row = $row.",LU,RLU,LP,RLP,LI,RLI,LOR,LO,RLO,LOR";
				}						
			}elseif(!strcmp('Baixo ',$potencial)){
				if(!strcmp('Pequeno',$row)){
					$row = $row.",LUR,LU";
				}elseif(!strcmp('Mínimo',$row)){
					$row = $row.",LUR,LU";
				}else{
					$row = $row.",LU,RLU,LP,RLP,LI,RLI,LOR,LO,RLO,LOR";
				}						
			}else{
				$row = $row.",LU,RLU,LP,RLP,LI,RLI,LOR,LO,RLO,LOR";	
			}
				
			
			echo $row;
			
		
	}else{
		$row="Dado Invalido";
		echo $row;
		exit();
	}






?>