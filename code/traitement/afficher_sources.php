<?php

$request = $db->query('SELECT * FROM source');

$sources = [];
while ($source = $request->fetch())
{
	$sources[] = $source;
}

$request->closeCursor();

echo json_encode($sources);
