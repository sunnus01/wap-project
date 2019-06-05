<?php
require 'includes/configg123.php';
require 'Examples/Example.php';
require 'includes/steamauth/userInfo.php';

$self = $_SERVER['PHP_SELF'];
//Get the steamid (really the community id)
$communityid = $_SESSION['steamid'];
//Get the map name
//See if the second number in the steamid (the auth server) is 0 or 1. Odd is 1, even is 0
$authserver = bcsub($communityid, '76561197960265728') & 1;
//Get the third number of the steamid
$authid = (bcsub($communityid, '76561197960265728')-$authserver)/2;
//Concatenate the STEAM_ prefix and the first number, which is always 0, as well as colons with the other two numbers
$steamid = "STEAM_1:$authserver:$authid";
$name = htmlspecialchars($steamprofile["personaname"]);

$stid = $_SESSION['steamid'];
if (!isset($_SESSION['steamid'])) { echo 'Please login';}
else {


//GET VIP START
$conn = new mysqli($servername, $username, $password, $dbvip);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM vip_users WHERE auth = '$steamid'";
$result = $conn->query($sql);

if ($result->num_rows != 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$id = $row["id"];
		echo 'You are allready <stong>VIP</strong>.';
		
    }
} else {
    echo "<p> <p><p>";
}
$conn->close();

$conn = new mysqli($servername, $username, $password, $dbvip);
$sql1 = "SELECT `group`,expires FROM vip_overrides WHERE user_id = '$id'";
$result = $conn->query($sql1);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		if ($row["expires"] != 0) {
			$vip = 1;
			$_SESSION['vip'] = $vip;
		echo '<p>Your are: '.$row["group"].' <p> until: '.date('H:i d.F.Y', $row["expires"]);}
		else {
			echo '<p>Your are: '.$row["group"].' <p> until : Forever';
		}
		$conn->close();
    }
} else {
		$leitud = otsinime($Players, 'Name', $steamprofile["personaname"]);
		if (is_bool($leitud) === true){
			echo '<p>You are Offline, GET your Vip now';
			echo '
<form method="post" action="'.shopvip.'">
  <select name="vip">
	<option value="">--Select VIP--</option>
    <option value="1 day">1 day - 3 coins</option>
	<option value="10 days">10 days - 25 coins</option>
	<option value="30 days">30 days -  50 coins</option>
	<option value="190 days">190 days -  300 coins</option>
	<option value="365 days">365 days -  500 coins</option>
  </select>
  <br><br>
  <input type="submit" value="GET VIP">
</form>';
		}
		else {
			echo '<p>You are Online, please disconnect from server to buy VIP.<p><a href="https://www.weallplay.eu/csgo">https://www.weallplay.eu/csgo</a>';
}
		
   
$coins = $_SESSION['waps'];
if($_POST['vip'] && $_POST['vip'] != 0)
{
   $vip=$_POST['vip'];
   // 1 day
   if ($vip == '1 day' && is_bool($leitud) === true) {
   $nowtime = time();
   $addday = $nowtime + 86400;
		if ($coins < 2){ echo '<p><strong>You dont have enough WAPs, missing '. abs($coins - 3) .' </strong>';}
			else {
			$newcoinsvip = $coins - 3;
			$conn = new mysqli($servername, $username, $password, $dbweapons);
			// Check connection
			if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);}
			echo '<p> Coins Left: '.$newcoinsvip;
			$sql5 = "UPDATE web_coins SET coins = $newcoinsvip WHERE steamid = $stid ";
			$result4 = $conn->query($sql5);
			echo '<p>You selected '.htmlspecialchars($vip);
   // BD vip sisestus
   $conn = new mysqli($servername, $username, $password, $dbvip);
	// Check connection
	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	}
	$sql2 = "INSERT INTO `vip_users` (`auth`, `name`) VALUES ('$steamid', '$name')";
	$result1 = $conn->query($sql2);
	$sql3 = "SELECT * FROM `vip_users` WHERE `auth` = '$steamid'";
	$result2 = $conn->query($sql3);
	if ($result2->num_rows != 0) {
    // output data of each row
    while($row = $result2->fetch_assoc()) {
		$idnew = $row["id"];
		//echo $idnew;
	} }
	$sql4 = "INSERT INTO `vip_overrides` (`user_id`, `server_id`, `group`, `expires`) VALUES ('$idnew', '0', 'Vip-Full', '$addday')";
	$result3 = $conn->query($sql4);
	$conn->close();
}
   }
   // 10 day
      elseif ($vip == '10 days' && is_bool($leitud) === true) {
   $nowtime = time();
   $addday = $nowtime + 864000;
		if ($coins < 25){ echo '<p><strong>You dont have enough WAPs, missing '. abs($coins - 25) .' </strong>';}
			else {
				$newcoinsvip = $coins - 25;
			$conn = new mysqli($servername, $username, $password, $dbweapons);
			// Check connection
			if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);}
			echo '<p> Coins Left: '.$newcoinsvip;
			$sql5 = "UPDATE web_coins SET coins = $newcoinsvip WHERE steamid = $stid";
			$result4 = $conn->query($sql5);
   echo '<p>You selected '.htmlspecialchars($vip);
   // BD sisestus
   $conn = new mysqli($servername, $username, $password, $dbvip);
	// Check connection
	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	}
	$sql2 = "INSERT INTO `vip_users` (`auth`, `name`) VALUES ('$steamid', '$name')";
	$result1 = $conn->query($sql2);
	$sql3 = "SELECT * FROM `vip_users` WHERE `auth` = '$steamid'";
	$result2 = $conn->query($sql3);
	if ($result2->num_rows != 0) {
    // output data of each row
    while($row = $result2->fetch_assoc()) {
		$idnew = $row["id"];
		//echo $idnew;
	} }
	$sql4 = "INSERT INTO `vip_overrides` (`user_id`, `server_id`, `group`, `expires`) VALUES ('$idnew', '0', 'Vip-Full', '$addday')";
	$result3 = $conn->query($sql4);
	$conn->close();
}
   }
   // 30 days
      elseif ($vip == '30 days' && is_bool($leitud) === true) {
   $nowtime = time();
   $addday = $nowtime + 2592000;
   $newcoinsvip = $coins - 50;
		if ($coins < 50){ echo '<p><strong>You dont have enough WAPs, missing '. abs($coins - 50) .' </strong>';}
			else {
			$conn = new mysqli($servername, $username, $password, $dbweapons);
			// Check connection
			if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);}
			echo '<p> Coins Left: '.$newcoinsvip;
			$sql5 = "UPDATE web_coins SET coins = $newcoinsvip WHERE steamid = $stid";
			$result4 = $conn->query($sql5);
   echo '<p>You selected '.htmlspecialchars($vip);
   // BD sisestus
   $conn = new mysqli($servername, $username, $password, $dbvip);
	// Check connection
	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	}
	$sql2 = "INSERT INTO `vip_users` (`auth`, `name`) VALUES ('$steamid', '$name')";
	$result1 = $conn->query($sql2);
	$sql3 = "SELECT * FROM `vip_users` WHERE `auth` = '$steamid'";
	$result2 = $conn->query($sql3);
	if ($result2->num_rows != 0) {
    // output data of each row
    while($row = $result2->fetch_assoc()) {
		$idnew = $row["id"];
		//echo $idnew;
	} }
	$sql4 = "INSERT INTO `vip_overrides` (`user_id`, `server_id`, `group`, `expires`) VALUES ('$idnew', '0', 'Vip-Full', '$addday')";
	$result3 = $conn->query($sql4);
	$conn->close();
}
   }
   // 190 days
      elseif ($vip == '190 days' && is_bool($leitud) === true) {
   $nowtime = time();
   $addday = $nowtime + 16416000;
		if ($coins < 300){ echo '<p><strong>You dont have enough WAPs, missing '. abs($coins - 300) .' </strong>';}
			else {
			$newcoinsvip = $coins - 300;
			$conn = new mysqli($servername, $username, $password, $dbweapons);
			// Check connection
			if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);}
			echo '<p> Coins Left: '.$newcoinsvip;
			$sql5 = "UPDATE web_coins SET coins = $newcoinsvip WHERE steamid = $stid";
			$result4 = $conn->query($sql5);
   echo '<p>You selected '.htmlspecialchars($vip);
   // BD sisestus
   $conn = new mysqli($servername, $username, $password, $dbvip);
	// Check connection
	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	}
	$sql2 = "INSERT INTO `vip_users` (`auth`, `name`) VALUES ('$steamid', '$name')";
	$result1 = $conn->query($sql2);
	$sql3 = "SELECT * FROM `vip_users` WHERE `auth` = '$steamid'";
	$result2 = $conn->query($sql3);
	if ($result2->num_rows != 0) {
    // output data of each row
    while($row = $result2->fetch_assoc()) {
		$idnew = $row["id"];
		//echo $idnew;
	} }
	$sql4 = "INSERT INTO `vip_overrides` (`user_id`, `server_id`, `group`, `expires`) VALUES ('$idnew', '0', 'Vip-Full', '$addday')";
	$result3 = $conn->query($sql4);
	$conn->close();
 }
}
   // 365 days
      elseif ($vip == '365 days' && is_bool($leitud) === true) {
   $nowtime = time();
   $addday = $nowtime + 31536000;
   
		if ($coins < 500){ echo '<p><strong>You dont have enough WAPs, missing '. abs($coins - 500) .' </strong>';}
			else {
				$newcoinsvip = $coins - 500;
			$conn = new mysqli($servername, $username, $password, $dbweapons);
			// Check connection
			if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);}
			echo '<p> Coins Left: '.$newcoinsvip;
			$sql5 = "UPDATE web_coins SET coins = $newcoinsvip WHERE steamid = $stid";
			$result4 = $conn->query($sql5);
   echo '<p>You selected '.htmlspecialchars($vip);
   // BD sisestus
   $conn = new mysqli($servername, $username, $password, $dbvip);
	// Check connection
	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	}
	$sql2 = "INSERT INTO `vip_users` (`auth`, `name`) VALUES ('$steamid', '$name')";
	$result1 = $conn->query($sql2);
	$sql3 = "SELECT * FROM `vip_users` WHERE `auth` = '$steamid'";
	$result2 = $conn->query($sql3);
	if ($result2->num_rows != 0) {
    // output data of each row
    while($row = $result2->fetch_assoc()) {
		$idnew = $row["id"];
		//echo $idnew;
	} }
	$sql4 = "INSERT INTO `vip_overrides` (`user_id`, `server_id`, `group`, `expires`) VALUES ('$idnew', '0', 'Vip-Full', '$addday')";
	$result3 = $conn->query($sql4);
	$conn->close();
				}
															}	
  else {
	echo '<p>Very clever, but not today ;)';
		}
}

$conn->close();
}
}
/*

		
*/
?>