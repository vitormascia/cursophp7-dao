<?php

	require_once("config.php");

	//----------------------------------------------------------

	// $sql = new SQL();

	// $n1 = "Bigua";
	// $n2 = "Biguazera";
	// $p = 123456;

	// Exemplo de um SELECT mais complexo

	// $users = $sql->select("SELECT deslogin, dessenha 
	// 	FROM tb_usuarios 
	// 	WHERE (deslogin IN (:N1, :N2)) OR (dessenha = :P) 
	// 	ORDER BY idusuario",
	// 	array(":N1"=>$n1, ":N2"=>$n2, ":P"=>$p)
	// );

	// echo json_encode($users);

	//----------------------------------------------------------

	// Carrega 1 usuário
	// $user = new User();

	// $user->loadById(13);

	// O objeto que está em $user é printado pelo __toString
	// echo $user;

	//----------------------------------------------------------

	// Carrega uma lista de usuários
	// $list = User::getList();

	// A função getList retorna um JSON de um array de arrays, com a tabela completa do BD
	// echo $list;

	//----------------------------------------------------------

	// Carrega uma lista de usuários buscando pelo login
	// $search = User::search("mascia");

	// echo $search;

	//----------------------------------------------------------

	// Carrega um usuário usando o login e a senha
	// $user = new User();

	// $user->login("Pirata","885695");

	// echo $user;

	//----------------------------------------------------------

	// Insert de um novo usuário

	// $user = new User("BelgaNato", "982342");

	// $user->insert();

	// echo $user;

	//----------------------------------------------------------

	// Dando update em um usuário

	// $user = new User();

	// $user->loadById(18);

	// $user->update("Kyoto329", "ap17ap21");

	// echo $user;

	//----------------------------------------------------------

	// Deletando um usuário

	$user = new User();

	$user->loadById(20);

	$user->delete();

	echo $user;

?>