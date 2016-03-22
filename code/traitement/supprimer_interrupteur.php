<?php

$bdd->query('DELETE FROM iv WHERE id = ' . $_POST['id_interrupteur']);
$bdd->query('DELETE FROM pilotage_iv_charge WHERE IDIv = ' . $_POST['id_interrupteur']);
