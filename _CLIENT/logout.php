<?php
	session_start();
	$this->logoutExternalUser();
	unset($_SESSION['uni_ext_id']);
	unset($_SESSION['uni_ext_username']);
	unset($_SESSION['uni_ext_cpf']);
	unset($_SESSION['uni_ext_login']);

// header("Location:index.php");
?>