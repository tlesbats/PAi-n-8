<?php

$request = $bd->prepare('UPDATE programmation p SET p.date_debut = :date_debut_nouvelle, p.date_fin = :date_fin_nouvelle
	JOIN objet_programmation op ON op.IDProgrammation = p.id
	JOIN constitution_groupe cp on cp.IDObjet = op.IDObjet
	JOIN objet o ON o.id = cp.IDObjet
	JOIN groupe g ON g.id = cp.IDGroupe WHERE g.nameGroupe = :nomGroupe AND o.nom = :nomObjet AND p.date_debut = :date_debut AND p.date_fin = :date_fin');
$request->bindParam(':date_debut_nouvelle', $_POST['date_debut_nouvelle'], PDO::PARAM_STR);
$request->bindParam(':date_debut_fin', $_POST['date_debut_fin'], PDO::PARAM_STR);
$request->bindParam(':nomGroupe', $_POST['salle'], PDO::PARAM_STR);
$request->bindParam(':nomObjet', $_POST['charge'], PDO::PARAM_STR);
$request->bindParam(':date_debut', $_POST['date_debut'], PDO::PARAM_STR);
$request->bindParam(':date_fin', $_POST['date_fin'], PDO::PARAM_STR);

$request->execute();
$request->closeCursor();
