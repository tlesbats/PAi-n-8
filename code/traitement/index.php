<?php

include_once('../classes/compte');

if (isset($_POST['username']) && isset($_POST['password']))
{
	$request = $bdd->prepare('SELECT * FROM compte WHERE username = :username AND password = :password');

	$request->bindValue(':username', $_POST['username'], PDO::PARAM_STR);
	$request->bindValue(':password', $_POST['password'], PDO::PARAM_STR);

	$request->execute();

	if ($request)
	{
		$compte = new Compte();
		$compte->hydrate($request->fetch());
		session_start();
		$_SESSION['id'] = $compte->id();
		switch($compte->type())
		{
			case 1: //utilisateur Normal
				header('Location: ../../src/normal.html');
				break;
			case 2: //admin
				header('Location: ../../src/admin.html');
				break;
			case 3: //agent de maintenance
				header('Location: ../../src/agent.html');
				break;
		}
	}
	else {
		header('Location: ../../src/index.html');
	}
} else {
	header('Location: ../../src/index.html');
}
