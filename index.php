<?php

	require_once("config.php");

	$sql = new SQL();

	$users = $sql->select("SELECT deslogin, dessenha 
		FROM tb_usuarios 
		WHERE (deslogin IN ('Bigua', 'Biguazera')) OR (dessenha = 123456) 
		ORDER BY idusuario");

	echo json_encode($users);

?>