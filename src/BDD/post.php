<?php
$ex = $_POST['name'];

$bd = new PDO('mysql:host=localhost;dbname=edison_ways', 'root', ''); 
$bd->query('SET NAMES utf8'); 
$ex="'".$ex."'";

$charges=$bd->query("SELECT * FROM charges WHERE nom=".$ex);
echo json_encode($charges->fetchAll());

