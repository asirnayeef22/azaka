<?php

//header
header("content-type: text/xml");

//includes
include_once "../include/db.php";

//create objects
$newObj = new Database;

$query = $newObj->qry("SELECT id, username FROM users");
$username = array();
while($user = $newObj->fetchLast()){
   $username[$user['id']] = $user['username'];
}

echo "<?xml version=\"1.0\" ?>";

//suggested output:
echo "<shoutbox>";

$query = $newObj->qry("SELECT * FROM shoutbox ORDER BY time DESC LIMIT 0,5");
while($values = $newObj->fetchLast())
	echo "<message><user>{$username[$values['uid']]}</user><time>{$values['time']}</time><content>{$values['message']}</content></message>";

echo "</shoutbox>";
?>
