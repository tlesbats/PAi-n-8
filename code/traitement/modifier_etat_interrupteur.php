<?php

$request = $bd->query('SELECT etat, pilotable FROM charge WHERE id = ' . $_POST['id']);
$donnee = $request->fetch();
$request->closeCursor();
$resultat['resultat'] = 0;

if ($donnee['pilotable'])
{
	$request = $bd->query('UPDATE charge SET etat = ' . (1 - $donnee['etat']) . ' WHERE id = ' . $_POST['id']);
	$resultat = 1;
}

echo json_encode($resultat);
