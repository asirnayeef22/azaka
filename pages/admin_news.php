<?php
include_once "../include/page.php";
include_once "../include/linklist.php";
$p = new Page("news",2);
$l = new LinkList($p->u);

$l->additem("news items","news", 0);
echo $l->dispList();

if(!isset($_GET['action'])){
	//if no action, do nothing. This is just so we do not need to check every time.
} elseif ($_GET['action']=='add')
	if((!isset($_GET['item'])) || $_GET['item']=="")
		$p->db->qry("INSERT INTO news (title, uid, content) VALUES ('{$_GET['title']}','{$p->u->id}', '".addSlashes($_GET['newscontent'])."')");
	else
		$p->db->qry("UPDATE news SET uid = '{$p->u->id}',time = CURRENT_TIMESTAMP, title = '{$_GET['title']}',content = '".addSlashes($_GET['newscontent'])."' WHERE id='".$_GET['item']."'");
  elseif ($_GET['action']=='modify'){
    extract($_GET);
	$p->db->qry("SELECT title, content FROM news WHERE id='$item' LIMIT 1");
	$row = $p->db->fetchLast();
	$p->addJs("document.addnews.newscontent.value='".addSlashes($row['content'])."';");
	$p->addJs("document.addnews.title.value='{$row['title']}';");
	$p->addJs("document.addnews.item.value='$item';");
} elseif ($_GET['action']=='delete')
	$p->db->qry("DELETE FROM news WHERE id = {$_GET['item']}");
//modify

//delete


//new
echo "<form name=\"addnews\" id=\"addnews\" onsubmit=\"doPost('pages/admin_news.php',this);false;\">
<input type=\"text\" name=\"title\" />: {$p->u->username} at [now] wrote:<blockquote><textarea id=\"newscontent\" name=\"newscontent\" cols=\"45\" rows=\"5\"></textarea></blockquote><input type=submit /><input type=\"hidden\" name=\"item\" id=\"item\" value=\"\" /></form><br/>";

//show all articles
$p->db->qry("SELECT n.*, u.username AS poster FROM news AS n, users AS u WHERE u.id = n.uid ORDER BY time DESC");
while($row = $p->db->fetchLast()){
	extract($row);
	echo "$title: $poster at $time wrote:
	(<a href=\"javascript:if(confirm('Are you sure?'))doPost('pages/admin_news.php?action=delete&item=$id');\">delete</a> or
	<a href=\"javascript:doPost('pages/admin_news.php?action=modify&item=$id');\">edit</a>)
	<blockquote><pre>$content</pre></blockquote>";
}
?>