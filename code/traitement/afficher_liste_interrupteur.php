<?php

include_once('../classes/groupe.php');

$request = $db->prepare('SELECT id, nom, etat FROM groupe WHERE nom=:nom');

$request->bindParam(':nom', $_POST['salle'], PDO::PARAM_STR);
$request->execute();
$request->closeCursor();

echo json_encode($request->fetch());
?>
