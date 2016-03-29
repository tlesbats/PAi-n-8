<?php

$request = $bdd->query('DELETE FROM groupe WHERE id = ' . $_POST['id']);
$request->closeCursor();
