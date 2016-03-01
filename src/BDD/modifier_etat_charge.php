<?php
include("connexion_BDD.php");

$request = $bdd->query('SELECT etatCommande , pilotable FROM charge WHERE id = ' . $_POST['id']);
$donnee = $request->fetch();
$request->closeCursor();
$resultat['resultat'] = 0;

if ($donnee['pilotable'])
{/* Attention à la différence entre etat de comande et etat effectif*/
	$request = $bdd->query('UPDATE charge SET etatCommande = ' . (1 - $donnee['etatCommande']) . ' WHERE id = ' . $_POST['id']);
	$request = $bdd->query('UPDATE objet SET etatEffectif = ' . (1 - $donnee['etatCommande']) . ' WHERE id = ' . $_POST['id']);
}

echo json_encode($resultat);
