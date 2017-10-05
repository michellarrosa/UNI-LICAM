<?php
//########################## GERADOR DE PORTE ##############################

$potencial = trim($_POST['potencial'],'\n');
$codigo_atividade = trim($_POST['atividade_cod']);
$atividade_tamanho =  trim($_POST['atividade_tamanho']);

if($atividade_tamanho > 0){

   if(strrpos($atividade_tamanho, ',') && strrpos($atividade_tamanho, '.')){
      //echo 'qui!';
      $atividade_tamanho = str_replace('.', '', $atividade_tamanho); 
      $atividade_tamanho = str_replace(',', '.', $atividade_tamanho); 
   }else{
      if(substr_count($atividade_tamanho, ',') == 1 && (substr_count($atividade_tamanho, '.') ==1 || substr_count($atividade_tamanho, '.')==2||substr_count($atividade_tamanho, '.')==3)){
        //echo 'qui@';
        $atividade_tamanho = str_replace('.', '', $atividade_tamanho); 
        $atividade_tamanho = $atividade_tamanho.'.00'; 
      }else{
         if(substr_count($atividade_tamanho,'.') == 1 && (strlen($atividade_tamanho) == 4) && (substr_count($atividade_tamanho,',') != 0)){
            $atividade_tamanho = str_replace('.', '', $atividade_tamanho); 
            //echo 'qui#';
            $atividade_tamanho = $atividade_tamanho.'.00'; 
         }else{
            if(strlen($atividade_tamanho) == 5){
              //echo 'qui#oaoa';
               if(substr_count($atividade_tamanho,',') == 1){
                   $atividade_tamanho = str_replace(',', '.', $atividade_tamanho); 
                 $atividade_tamanho = $atividade_tamanho.'.00'; 
               }
            }else{
              //echo 'quiasa#';
              $atividade_tamanho = str_replace(',', '.', $atividade_tamanho);
            }
         } 
      }
   }
   $sql="SELECT minimo_inferior, minimo_superior, pequeno_inferior, pequeno_superior, medio_inferior, medio_superior, grande_inferior, grande_superior, ex_inferior, ex_superior FROM uni__licam_atividades_tabela WHERE codramo = '".$codigo_atividade."'";
   $result = $this->execQuery($sql)['result'];
    $min_sup =trim($result[0]['minimo_superior']);
    $min_inf =trim($result[0]['minimo_inferior']);
    $peq_sup =trim($result[0]['pequeno_superior']);
    $peq_inf =trim($result[0]['pequeno_inferior']);
    $med_sup =trim($result[0]['medio_superior']);
    $med_inf =trim($result[0]['medio_inferior']); 
    $gran_sup = trim($result[0]['grande_superior']);
    $gran_inf = trim($result[0]['grande_inferior']);
    $ex_sup = trim($result[0]['ex_superior']);
    $ex_inf = trim($result[0]['ex_inferior']);
//      echo $atividade_tamanho,"lol";
   if( $atividade_tamanho < $min_inf ){
		$row=0; //não lienciavel
	}elseif( ( ($atividade_tamanho >= $min_inf)&&($atividade_tamanho<= $min_sup) ) && (($min_inf != -1)&&($min_sup != -1) )){
		$row="Mínimo";
	}elseif( ( ($atividade_tamanho >= $peq_inf)&&($atividade_tamanho<= $peq_sup) ) && (($peq_inf != -1)&&($peq_sup != -1)) ){
		$row="Pequeno";					
	}elseif( ( ($atividade_tamanho >= $med_inf)&&($atividade_tamanho <= $med_sup) ) && (($med_inf != -1)&&($med_sup != -1)) ){
		$row="Médio";
	}elseif((($atividade_tamanho >= $min_sup) && ($atividade_tamanho < $peq_inf)) &&  ($peq_inf != -1)){
		$row="Mínimo";
	}elseif( ( ($atividade_tamanho >= $gran_inf)&&($atividade_tamanho <= $gran_sup) ) && (($gran_inf != -1)&&($gran_sup != -1)) ){
		$row="Grande";
	}elseif( ( ($atividade_tamanho >= $ex_inf)&&($atividade_tamanho >= PHP_INT_MAX)||($atividade_tamanho <= $ex_sup)  ) && (($ex_inf != -1)&&($ex_sup != -1)) ){
		$row="Excepcional";
	}elseif(($atividade_tamanho == $min_inf) && ($min_sup == -1) &&($min_sup != 9999999.00)){
         $row="Mínimo";
      }elseif(($atividade_tamanho > $min_sup) && ($peq_inf == -1) &&($min_sup == 9999999.00)){
         $row="Excepcional";
      }elseif(($atividade_tamanho > $min_sup) && ($peq_inf == -1) &&($min_sup != 9999999.00)){
            $row=1;//Licenciavel pela FEPAM
      }elseif(($atividade_tamanho >= $min_inf) && ($min_sup == -1)&&($min_inf != 9999999.00)){
            $row=1;
      }elseif(($atividade_tamanho > $min_inf) && ($min_sup == -1)&&($min_inf == 9999999.00)){
         $row="Excepcional";
      }elseif(($atividade_tamanho > $peq_sup) && ($med_inf == -1) &&($peq_sup == 9999999.00)){
         $row="Excepcional";
      }elseif(($atividade_tamanho > $peq_sup) && ($med_inf == -1) &&($peq_sup != 9999999.00)){
            $row=1;//Licenciavel pela FEPAM
      }elseif(($atividade_tamanho > $peq_inf) && ($peq_sup == -1)&&($peq_inf != 9999999.00)){
            $row=1;
      }elseif(($atividade_tamanho > $peq_inf) && ($peq_sup == -1)&&($peq_inf == 9999999.00)){
         $row="Excepcional";
      }elseif(($atividade_tamanho > $med_sup) && ($gran_inf == -1) &&($med_sup == 9999999.00)){
         $row="Excepcional";
      }elseif(($atividade_tamanho > $med_sup) && ($gran_inf == -1) &&($med_sup != 9999999.00)){
            $row=1;//Licenciavel pela FEPAM
      }elseif(($atividade_tamanho > $med_inf) && ($med_sup == -1)&&($med_inf != 9999999.00)){
            $row=1;
      }elseif(($atividade_tamanho > $med_inf) && ($med_sup == -1)&&($med_inf == 9999999.00)){
         $row="Excepcional";
      }elseif(($atividade_tamanho > $gran_sup) && ($ex_inf == -1) &&($gran_sup == 9999999.00)){
         $row="Excepcional";
      }elseif(($atividade_tamanho > $gran_sup) && ($ex_inf == -1) &&($gran_sup != 9999999.00)){
            $row=1;//Licenciavel pela FEPAM
      }elseif(($atividade_tamanho > $gran_inf) && ($gran_sup == -1)&&($gran_inf != 9999999.00)){
            $row=1;
      }elseif(($atividade_tamanho > $gran_inf) && ($gran_sup == -1)&&($gran_inf == 9999999.00)){
         $row="Excepcional";
      }elseif(($atividade_tamanho > $ex_sup) && ($ex_sup == 9999999.00)){
         $row="Excepcional";
      }elseif(($atividade_tamanho > $ex_sup) && ($ex_sup != 9999999.00)){
            $row=1;//Licenciavel pela FEPAM
      }elseif(($atividade_tamanho > $ex_inf) && ($ex_sup == -1)&&($ex_inf != 9999999.00)){
            $row=1;
      }elseif(($atividade_tamanho > $ex_inf) && ($ex_sup == -1)&&($ex_inf == 9999999.00)){
         $row="Excepcional";
      }      
   
//   echo $atividade_tamanho;
   if(strcmp('Médio',$potencial)==0){
      if(strcmp('Pequeno',$row)==0){
         $row = $row.",2";
      }else{
         if(strcmp('Mínimo',$row)==0){
            $row = $row.",2";
         }else{
            $row = $row.",3";
         }
      }
   }else{
      if(strcmp('Baixo',$potencial)==0){
         if(strcmp('Pequeno',$row)==0){
            $row = $row.",2";
         }else{
            if(strcmp('Mínimo',$row)==0){
               $row = $row.",2";
            }else{
               $row = $row.",3";
            }
         }
      }else{
         if(strcmp('Alto',$potencial)==0){
            $row = $row.",3";
         }  
      }
   }


}else{
	$row="Dado Inválido";//bloquear tipo de licença quando dado invalido
	echo $row.' = '.$atividade_tamanho;
	exit();
}
	echo $row;
?>