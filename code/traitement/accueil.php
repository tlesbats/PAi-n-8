<?php

session_start();

include_once('../classes/groupe.php');
include_once('../classes/compte');

$groupeManager = new GroupeManager();
$groupes = $groupeManager->getList();
echo json_encode($groupes);

$compteManager = new CompteManager();
$compte = $compteManager->get($_SESSION['id']);
echo json_encode($compte);

$groupesBug = [];

$request = $bd->pquery('SELECT * FROM groupe g
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
echo json_encode($groupesBug);

?>
