<?php
$bd = new PDO('mysql:host=localhost;dbname=edison_ways', 'root', ''); 
$bd->query('SET NAMES utf8'); 


$charges=$bd->query("SELECT * FROM charges");
echo json_encode($charges->fetchAll());
