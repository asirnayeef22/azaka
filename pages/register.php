<?php
include_once "../include/page.php";
$p = new Page("registration",0);

if (isset($_GET['username']) && isset($_GET['password'])
	&& $result = mysql_fetch_array($p->db->qry("SELECT username, password FROM users WHERE username = '".$_GET['username']."'"))){
		if($result['password']==$_GET['password']){
			$p->u->updateCookies($_GET['username'], $_GET['password']);
			die($p->addJs("forceUpdateMods();forceHash();"));
		} else {
			//incorrect password
			echo "You seem to have inaccuratly typed your password.<br/>Poor you.<br/>Try again, or you can ask your benevolent admin to reset it...<br/><br/>Or you can register if you do not have a user account.<br/>";
		}	
} else if(isset($_GET['action']) && $_GET['action']=="logout"){
	$p->u->invalidateSession();
	$p->addJs("forceUpdateMods();forceHash();");
} else if (isset($_GET['action']) && $_GET['action']=="register"){
	echo "Here is the paperwork..<br/><br/>";
} else if (isset($_GET['action']) && $_GET['action']=="registering"){
	echo "Alright - lets get you registered. One day.";	
} else {
	echo "Dunno who the heck you are... Fill this out if you want to register.<br/><br/>";
}
?>

<form id="register" name="register" method="get" action="
javascript:if(document.register.username.value == '' || 
document.register.password.value == '' || 
document.register.confirm.value == '' || 
document.register.firstname.value == '' || 
document.register.lastname.value =='' || 
document.register.doby.value == '' || 
document.register.email.value == '' ){
	alert('Please fill out ALL fields.');
} else if(document.register.username.value == 'guest'){
	alert('\'guest\' is not a valid username.');
	document.register.username.value = '';
} else if(document.register.password.value != document.register.confirm.value){
	alert('It seems you have entered your password WRONG. Fix it.');
	document.register.password.value = '';
	document.register.confirm.value = '';
} else if(false){
	alert('In case I think of something else.');
} else {
	alert('duurr... ok...');
	sendPost();
}
return false;">
  <table width="500" border="0">
    <tr>
      <td width="167">username</td>
      <td><input type="text" name="username" id="username" /></td>
    </tr>
    <tr>
      <td>password</td>
      <td><input type="password" name="password" id="password" /></td>
    </tr>
    <tr>
      <td>confirm</td>
      <td><input type="password" name="confirm" id="confirm" /></td>
    </tr>
    <tr>
      <td>first name</td>
      <td><input type="text" name="firstname" id="firstname" /></td>
    </tr>
    <tr>
      <td>last name</td>
      <td><input type="text" name="lastname" id="lastname" /></td>
    </tr>
    <tr>
      <td>date of birth</td>
      <td><select name="dobd" id="dobd">
        <option value="1">01</option>
        <option value="2">02</option>
        <option value="3">03</option>
        <option value="4">04</option>
        <option value="5">05</option>
        <option value="6">06</option>
        <option value="7">07</option>
        <option value="8">08</option>
        <option value="9">09</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
        <option value="24">24</option>
        <option value="25">25</option>
        <option value="26">26</option>
        <option value="27">27</option>
        <option value="28">28</option>
        <option value="29">29</option>
        <option value="30">30</option>
        <option value="31">31</option>
      </select>
        <select name="dobm" id="dobm">
        <option value="1">01</option>
        <option value="2">02</option>
        <option value="3">03</option>
        <option value="4">04</option>
        <option value="5">05</option>
        <option value="6">06</option>
        <option value="7">07</option>
        <option value="8">08</option>
        <option value="9">09</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
      </select>
      <input name="doby" type="text" id="doby" size="4" /></td>
    </tr>
    <tr>
      <td>email</td>
      <td><input type="text" name="email" id="email" /></td>
    </tr>
  </table>
  <tr><input type="submit" name="action" id="action" value="register" /></tr>
</form>


<?php


?>