<?php
//lien BDD
include("connexion_BDD.php");

$request = $bdd->prepare('SELECT iv.id, iv.nom, iv.etat FROM iv
	JOIN constitution_groupe cp ON cp.IDObjet = iv.id
	JOIN groupe g ON g.id = cp.IDGroupe WHERE g.id = :id');
$request->bindParam(':id', $_POST['groupe'], PDO::PARAM_STR);
$request->execute();
echo json_encode($request->fetchAll());
?>