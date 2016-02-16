<?php

session_start();

include_once('../classes/groupe.php');
include_once('../classes/compte');
include_once('select_groupe.php');

if (!isset($_POST['salle']))
{
    select_groupe($db, 0, 0);
}
else
{

}
