<?php

$request = $bdd->prepare('DELETE FROM consitution_groupe WHERE IDGroupe = :id_groupe AND idSousGroupe = :id_sous_groupe');
$request->bindParam(':id_groupe', $_POST['id_groupe'], PDO::PARAM_INT);
$request->bindParam(':id_sous_groupe', $_POST['id_sous_groupe'], PDO::PARAM_INT);

$request->execute();
$request->closeCursor();

$idSousGroupe = array(
	'id_sous_groupe' => $_POST['id_sous_groupe']
);

echo json_encode($idSousGroupe);
