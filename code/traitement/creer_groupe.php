<?php

$request = $bdd->prepare('INSERT INTO groupe VALUES('', :nom, :icone, 1)');
$request->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
$request->bindParam(':icone', $_POST['icone'], PDO::PARAM_STR);
$request->execute();
$request->closeCursor();

$idNewGroupe = $bdd->lastinsertId();

foreach ($_POST['tableau_charge'] as $id)
{
	$request = $bdd->prepare('INSERT INTO constitution_groupe VALUES('', :IDGroupe, :IDObjet)');
	$request->bindParam(':IDGroupe', $idNewGroupe, PDO::PARAM_INT);
	$request->bindParam(':IDObjet', $id, PDO::PARAM_INT);
	$request->execute();
	$request->closeCursor();
}

$request = $bdd->prepare('INSERT INTO constitution_groupe VALUES('', :IDGroupe, NULL, :idSousGroupe)');
$request->bindParam(':IDGroupe', $_POST['id_groupe'], PDO::PARAM_INT);
$request->bindParam(':idSousGroupe', $idNewGroupe, PDO::PARAM_INT);
$request->execute();
$request->closeCursor();
