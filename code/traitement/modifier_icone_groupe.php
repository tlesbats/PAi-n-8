<?php

$request = $bdd->prepare('UPDATE groupe SET icone = :icone WHERE id = :id');

$request->bindParam(':icone', $_POST['icone'], PDO::PARAM_INT);
$request->bindParam(':id', $_POST['id'], PDO::PARAM_INT);

$request->execute();
$request->closeCursor();

$newIcone = array(
	'icone' => $_POST['icone']
);

echo json_encode($newIcone);
