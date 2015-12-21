<?php

include_once('../classes/compte');

if (isset($_POST['username']) && isset($_POST['password']))
{
	$request = $bdd->prepare('SELECT * FROM compte WHERE username = :username AND password = :password');

	$request->bindValue(':username', $_POST['username'], PDO::PARAM_STR);
	$request->bindValue(':password', sha1('edison').sha1(md5(($_POST['password']))).sha1('ways')., PDO::PARAM_STR);

	$request->execute();

	if ($request)
	{
		$compte = new Compte();
		$compte->hydrate($request->fetch());

		session_start();
		$_SESSION['username'] = $compte->username();
		$_SESSION['id'] = $compte->id();
		$_SESSION['type'] = $compte->type();

		header('Location: ../../src/acceuil.html');
	}
	else {
		header('Location: ../../src/index.html');
	}
} else {
	header('Location: ../../src/index.html');
}
