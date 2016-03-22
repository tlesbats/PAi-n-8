<?php

$request = $db->prepare('SELECT iv.id, iv.nom, iv.etat FROM iv
	JOIN pilotage_iv_charge pic ON pic.IDIv = iv.id
	JOIN groupe g ON g.id = pic.IDGroupe_Affichage WHERE g.id = :id');

$request->bindParam(':id', $_POST['salle'], PDO::PARAM_STR);
$request->execute();

echo json_encode($request->fetchAll());
?>
