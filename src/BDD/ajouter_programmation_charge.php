<?php

$request = $bd->prepare('INSERT INTO programmation(programmation, date_debut, date_fin) VALUES(:programmation, :date_debut, :date_fin)');

$request->bindParam(':programmation', $_POST['programmation'], PDO::PARAM_INT);
$request->bindParam(':date_debut', $_POST['date_debut'], PDO::PARAM_STR);
$request->bindParam(':date_fin', $_POST['date_fin'], PDO::PARAM_STR);

$request->execute();
$request->closeCursor();

$idProgrammation = $bd->lastInsertId();
$request = $bd->prepare('SELECT o.id FROM objet o
	JOIN constitution_groupe cp ON cp.IDObjet = o.id
	JOIN groupe g ON g.id = cp.IDGroupe WHERE nameGroupe = :nomGroupe AND o.nom = :nomObjet');
$request->bindParam(':nomObjet', $_POST['charge'], PDO::PARAM_STR);
$request->bindParam(':nomGroupe', $_POST['salle'], PDO::PARAM_STR);
$request->execute();
$idObjet = $request->fetch();
$request->closeCursor();

$request = $bd->prepare('INSERT INTO objet_programmation(IDObjet, IDProgrammation) VALUES(:idProgrammation, :idObjet)');
$request->bindParam(':idProgrammation', $idProgramamtion, PDO::PARAM_INT);
$request->bindParam(':idObjet', $idObjet, PDO::PRAM_INT);
$request->execute();

$request->closeCursor();
