<?php
include_once "../include/page.php";
$p = new Page('profile',1);
echo "<pre>".print_r($_GET,true)."</pre>";

if(isset($_GET['action']) && $_GET['action']=='profile'){
	if($_GET['password']=='')
		$p->db->qry("UPDATE users SET firstname='{$_GET['fname']}',	lastname='{$_GET['lname']}', email='{$_GET['email']}' WHERE id='{$p->u->id}'");
	else{
		$p->db->qry("UPDATE users SET password='{$_GET['password']}',
firstname='{$_GET['fname']}',	lastname='{$_GET['lname']}',
email='{$_GET['email']}' WHERE id='{$p->u->id}'");
		$p->u->updatePassword($_GET['password']);
	}
}

$p->db->qry("SELECT * FROM users WHERE id='".$p->u->id."'");
extract($p->db->fetchLast());

$p->infoBox("To change your password fill out the password fields - or just leave them be to leave your password be.");

echo "<form name=\"profile\" id=\"profile\" type=\"get\" onsubmit=\"javascript:
if(document.profile.password.value == document.profile.cpassword.value){
	if(document.profile.password.value != '')
		document.profile.password.value=hex_md5(document.profile.password.value);
	document.profile.cpassword.value='';
	doPost('pages/profile.php',this);
} else {
	document.profile.password.value='';
	document.profile.cpassword.value='';
	document.profile.password.focus();
	errorMsg('Your passwords did not match. Have another go.')
} return false;\">
<table><tr><td>change password</td><td><input type=\"password\" name=\"password\" id=\"password\"/></td></tr>
<tr><td>confirm password</td><td><input type=\"password\" name=\"cpassword\" id=\"cpassword\"/></td></tr>
<tr><td>first name</td><td><input type=\"text\" name=\"fname\" id=\"fname\" value=\"$firstname\"/></td></tr>
<tr><td>last name</td><td><input type=\"text\" name=\"lname\" id=\"lname\" value=\"$lastname\"/></td></tr>
<tr><td>email</td><td><input type=\"text\" name=\"email\" id=\"email\" value=\"$email\"/></td></tr>
<tr><td><input type=\"submit\" value=\"update\"')\"/></td></tr>";
echo "</table></form>";
?>
