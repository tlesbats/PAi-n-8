<?php

$request = $bd->query('SELECT etatCommande, pilotable FROM charge WHERE id = ' . $_POST['id']);
$donnee = $request->fetch();
$request->closeCursor();
$resultat['resultat'] = 0;

if ($donnee['pilotable'])
{
	$request = $bd->query('UPDATE charge SET etatCommande = ' . (1 - $donnee['etatCommande']) . ' WHERE id = ' . $_POST['id']);
}

echo json_encode($resultat);
