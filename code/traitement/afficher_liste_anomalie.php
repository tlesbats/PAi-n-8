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
	$request = $bd->query('SELECT p.date, p.description, o.* FROM panne p, objet o
		WHERE o.id = p.IDObjet AND p.IDObjet = ' . $id . ' AND p.priorite > 0');
	while ($donnee = $reques->fetch())
	{
		$anomalies[] = array('id' => $id, 'description' => $donnee['description'], 'date' => $donnee['date'], 'nom' => $donnee['nom'],
			'localisation' => $donnee['localisation'], 'etatBug' => $donnee['etatBug'], 'etatEffectif' => $donnee['etatEffectif'],
			'consommation' => $donnee['consommation'], 'icone' => $donnee['icone']);
	}
	$request->closeCursor();
}

echo json_encode($anomalies);
