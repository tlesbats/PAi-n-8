<?php

$request = $bdd->query('SELECT etat FROM iv WHERE id = ' . $_POST['id']);
$donnee = $request->fetch();
$nouvelEtatIv = 1 - $donnee['etat'];
$request->closeCursor();

$request = $bdd->query('UPDATE iv SET etat = ' . $nouvelEtatIv . ' WHERE id = ' . $_POST['id']);
$request->closeCursor();

$request = $bdd->query('SELECT c.id, c.pilotable FROM charge c
	JOIN constitution_groupe cp ON cp.IDObjet = c.id
	JOIN pilotage_iv_charge pic ON pic.IDGroupe_Affichage = cp.IDGroupe WHERE pic.id = ' . $_POST['id']);

$ids = [];
while ($donnee = $request->fetch())
{
	if ($donnee['pilotable'])
	{
		$request = $bdd->query('UPDATE charge SET etatCommande = ' . $nouvelEtatIv . ' WHERE id = ' . $donnee['id']);
		$ids[] = $donnee['id'];
	}
}
$request->closeCursor();

echo json_encode($ids);
