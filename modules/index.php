<?php
include_once "../include/db.php";
$db = new Database();

$js = "<script id=\"modjs\">$(\"#modlist\").sortable();$(\"#modlist\").disableSelection();";
$db->qry("SELECT name, url, localrefresh, webrefresh FROM modules WHERE enabled = 1 AND onsidebar = 0 ORDER BY `order`");
echo "<ul style=\"list-style-type: none; margin: 0; padding: 0; width: 100%;\" id=\"modlist\">";
while($row = $db->fetchLast()){
	if(file_exists($row['url'])){
	include $row['url'];
		if($m->u->canAccess($m->accessreq)){
			$js .= "runJs('modjs-".$row['name']."');";
			$m->setRefresh($m->u->isLocal?$row['localrefresh']:$row['webrefresh']);
			echo "<li style=\"width:100%\"><div class=\"ui-state-default ui-corner-top\">{$m->name}</div>";
			echo "<div class=\"ui-widget-content ui-corner-bottom\">".$m->getContent()."</div><br/></li>";
			echo $m->getJs();
		}
	} else {
		echo "<li style=\"width:100%\"><div class=\"ui-widget-content ui-corner-all\">Fatal error loading {$row['name']}. Check to see if the module has been copied over, and that the database points to the correct file.</div><br/></li>";
	}
}
echo "</ul>".$js."</script>";
?>