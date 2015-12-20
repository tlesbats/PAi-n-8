<?php

$ex = $_POST['ex'];

$bd = new PDO('mysql:host=localhost;dbname=edison_ways', 'root', ''); 
$bd->query('SET NAMES utf8'); 

$callback=$ex;
$charges=$bd->query("SELECT * FROM charges");
foreach ($charges as $charge) {
	$nom=$charge['nom'];
 echo '<br><a href="frigo.html" class="red"><img src="images/frigo.png" style="height:100px;width:100px;"></a><br><span>'.$nom.'</span>';
}
