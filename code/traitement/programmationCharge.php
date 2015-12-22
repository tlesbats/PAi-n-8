<?php

include_once('../crontab.php');

if (isset($_POST['idToRemove']) && is_int($_POST['id']))
{
	retireScript($_POST['id']);
}
else if (isset($_POST['heure']))
{
	ajouteScript($_POST['heure'], $_POST['minute'], $_POST['jourMois'], $_POST['jourSemaine'],
		$_POST['mois'], $_POST['commande'], $_POST['commentaire'], $POST['idObjet']);
}
?>
