<?php

function select_groupe($db, $salle, $groupe)
{
	$groupes = [];
	$groupesBug = [];

	$request = $bd->query('SELECT * FROM groupe g WHERE salle = ' . $salle . ' AND ');
	if ($request)
	{
		while ($groupe = $request->fetch())
		{
			$groupes[] = $groupe;
		}
	}
	$request->closeCursor();

	$request = $bd->query('SELECT g.id FROM groupe g
	    JOIN constitution_groupe cp ON cp.IDGroupe = g.id
	    JOIN objet o ON o.id = cp.idObjet
	    WHERE o.etatBug = 1');
	if ($request)
	{
	    while ($donnees = $request->fetch())
	    {
	        $groupesBug[] = $donnees;
	    }
	}
	$request->closeCursor();
	foreach($groupes as $key => $groupe)
	{
		if (in_array($groupe['id'], $groupesBug))
		{
			$groupes[$key]['etatBug'] = 1;
		}
		else
		{
			$groupes[$key]['etatBug'] = 0;
		}
	}

	echo json_encode($groupes);
}
