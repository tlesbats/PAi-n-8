<?php

$request = $bd->query('SELECT pilotable FROM iv WHERE id = ' . $_POST['id']);
$donnee = $request->fetch();
$etatIv = $donnee['pilotable'];
$request->closeCursor();

$request = $bd->query('SELECT c.id, c.pilotable FROM charge c
	JOIN pilotage_iv_charge pic ON pic.C_IDObjet = c.id WHERE pic.id = ' . $_POST['id']);

$ids = [];
while ($donnee = $request->fetch())
{
	if ($donnee['pilotable'])
	{
		$request = $bd->query('UPDATE charge SET etatCommande = ' . $etatIv . ' WHERE id = ' . $donnee['id']);
		$ids[] = $donnee['id'];
	}
}
$request->closeCursor();

echo json_encode($ids);
