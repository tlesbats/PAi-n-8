<?php

$request = $bd->query('SELECT c.id, c.etatCommande, c.pilotable FROM charge c
	JOIN pilotage_iv_charge pic ON pic.C_IDObjet = c.id WHERE pic.id = ' . $_POST['id']);

$ids = [];
while ($donnee = $request->fetch())
{
	if ($donnee['pilotable'])
	{
		$request = $bd->query('UPDATE charge SET etatCommande = ' . (1 - $donnee['etatCommande']) . ' WHERE id = ' . $donnee['id']);
		$ids[] = $donnee['id'];
	}
}
echo json_encode($ids);
