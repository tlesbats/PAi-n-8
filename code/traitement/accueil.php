<?php

session_start();

include_once('../classes/groupe.php');
include_once('../classes/compte');

$groupeManager = new GroupeManager($bd);
$groupes = $groupeManager->getList();
echo json_encode($groupes);

$compteManager = new CompteManager($bd);
$compte = $compteManager->get($_SESSION['id']);
echo json_encode($compte);

$groupesBug = [];

$request = $bd->query('SELECT * FROM groupe g
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
