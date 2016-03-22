<?php

$request = $bd->query('SELECT pilotable FROM iv WHERE id = ' . $_POST['id']);
$donnee = $request->fetch();
$nouvelEtatIv = 1 - $donnee['etat'];
$request->closeCursor();

$request = $bd->query('UPDATE iv SET etat = ' . $nouvelEtatIv . ' WHERE id = ' . $_POST['id']);
$request->closeCursor();

$request = $bd->query('SELECT c.id, c.pilotable FROM charge c
	JOIN pilotage_iv_charge pic ON pic.C_IDObjet = c.id WHERE pic.id = ' . $_POST['id']);

$ids = [];
while ($donnee = $request->fetch())
{
	if ($donnee['pilotable'])
	{
		$request = $bd->query('UPDATE charge SET etatCommande = ' . $nouvelEtatIv . ' WHERE id = ' . $donnee['id']);
		$ids[] = $donnee['id'];
	}
}
$request->closeCursor();

echo json_encode($ids);
