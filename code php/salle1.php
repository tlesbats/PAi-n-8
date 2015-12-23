<?php

$request = $bdd->prepare('SELECT charge.* FROM charge,constitution_groupe WHERE constitution_groupe.IDGroupe = :IDGroupe AND constitution_groupe.IDObjet = charge.id');

if ($request)
{
    while ($donnees = $request->fetch())
    {
        $charges[] = $donnees;
    }
}
$request->closeCursor();
echo json_encode($charges);
