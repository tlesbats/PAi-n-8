<?php
//lien BDD
include("connexion_BDD.php");

$request = $bdd->prepare('SELECT p.id, p.programmation, p.date_debut, p.date_fin FROM programmation p
	JOIN objet_programmation op ON op.IDProgrammation = p.id
	JOIN objet o ON o.id = op.IDObjet
	JOIN constitution_groupe cp ON cp.IDObjet = o.id WHERE cp.IDGroupe = :salle AND o.id = :charge');

$request->bindParam(':salle', $_POST['salle'], PDO::PARAM_STR);
$request->bindParam(':charge', $_POST['charge'], PDO::PARAM_STR);

$request->execute();

$programmations = [];
while ($donnees = $request->fetch())
{
	$programmations[] = $donnees;
}

echo json_encode($programmations);
