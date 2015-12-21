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

?>
