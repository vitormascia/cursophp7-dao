<?php

	require_once("config.php");

	// $sql = new SQL();

	// $n1 = 'Bigua';
	// $n2 = 'Biguazera';
	// $p = 123456;

	// $users = $sql->select("SELECT deslogin, dessenha 
	// 	FROM tb_usuarios 
	// 	WHERE (deslogin IN (:N1, :N2)) OR (dessenha = :P) 
	// 	ORDER BY idusuario",
	// array(":N1"=>$n1, ":N2"=>$n2, ":P"=>$p)
	// );

	// echo "<pre>";
	// echo json_encode($users);
	// echo "</pre>";

	// echo "<br><br>";
	//----------------------------------------------------------

	$user = new User();

	$user->loadById(13);

	echo "<pre>";
	echo $user;
	echo "</pre>";

?>