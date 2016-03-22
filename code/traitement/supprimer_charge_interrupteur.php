<?php

$request = $bdd->prepare('DELETE FROM pilotage_iv_charge WHERE IDIv = :id_interrupteur AND C_IDObjet = :id_charge');

$request->bindParam(':id_interrupteur', $_POST['id_interrupteur'], PDO::PARAM_INT);
$request->bindParam(':id_charge', $_POST['id_charge'], PDO::PARAM_INT);

$request->execute();
$request->closeCursor();
