<?php

session_start();

include_once('../classes/groupe.php');
include_once('../classes/compte');
include_once('select_groupe.php');

select_groupe($db, 1);
