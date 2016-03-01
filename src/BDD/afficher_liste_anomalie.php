<?php

$request = $bd->prepare('SELECT id FROM objet o
	JOIN constitution_groupe cp ON cp.IDObjet = o.id WHERE cp.IDGroupe=:salle');
$request->bindParam(':salle', $_POST['salle'], PDO::PARAM_STR);
$request->execute();
$ids = [];

while ($donnes = $request->fetch())
{
	$ids[] = $donnes['id'];
}
$request->closeCursor();

$anomalies = [];
for ($id in $ids)
{
	$request = $bd->query('SELECT p.description FROM panne p
		JOIN objet o ON o.id = p.IDObjet WHERE p.IDObjet = ' . $id . ' AND p.priorite > 0');
	$anomalies[] = array('id' => $id, 'description' => $request->fetch());
	$request->closeCursor();
}

echo json_encode($anomalies);
