 <?php 
 	session_start();
 	
 	$value = $_REQUEST['hash'];
 	setcookie("id", $value, time()+3600 ,"/", $_SERVER['SERVER_NAME'] );
 	$sql = "SELECT * FROM uni__licam_perfildeusuario WHERE email='".$user_email."'";
	$busca_name = $this -> execQuery($sql)['result'];
	$_SESSION['user'] = $busca_name[0]['nome'];
	$_SESSION['login'] = TRUE;

	header("Location: http://localhost/Licam/index.php");
 ?>