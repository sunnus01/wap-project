<?php
require 'Examples/Example.php';
require 'includes/configg123.php';
include 'includes/steamauth/userInfo.php';
$stid = $_SESSION['steamid'];
if (!isset($_SESSION['steamid'])) {echo 'Please Login.';}
else {
$self = $_SERVER['PHP_SELF'];
$leitud = otsinime($Players, 'Name', $steamprofile["personaname"]);
// nyyd vaatame mis relvad meil on olemas andmebaasis ja toome neid listina v2lja
if ($_SESSION['vip'] == 1){
$conn = new mysqli($servername, $username, $password, $dbweapons);
// Check connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$result = $conn->query("SELECT count(*) as total FROM weapons_coins WHERE amount > '0';");
$row = $result->fetch_row();
echo '
<style>

table, tr, th, td {
	padding: 15px;
    text-align: left;
	border-collapse: collapse;
    width: 600px;
}
th, td {
    border-bottom: 1px solid #ddd;
}
tr:hover {background-color: #7a7a7a;}
</style>

<table id ="myTable2">
<tbody>

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle"
     style="display:block; text-align:center;"
     data-ad-layout="in-article"
     data-ad-format="fluid"
     data-ad-client="ca-pub-3095128368109002"
     data-ad-slot="7622771784"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
<tr>
<th onclick="sortTable(0)">Item Name:</th>
<td>Condition:</td>
<td></td>
<td>Avalible('.$row[0].')</td>
<th onclick="sortTable(1)">Price</th>
</tr>';

		


$conn = new mysqli($servername, $username, $password, $dbweapons);
// Check connectio

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM weapons_coins WHERE amount > '0'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		echo '<tr>';
		echo '<td>'.$row["itemname"].'</td>';
		echo '<td>'.$row["condition"].'</td>';
		$condition = $row["condition"];
		echo '<td><img src="'.$row["piclink"].'" height="100" width="100"></img></td>';
		echo '<td>'.$row["amount"].'</td>';
		echo '<td>'.$row["price"].'</td>';
		echo '</tr>';
    }
} else {
    echo "0 results";
}
echo '</tbody></table>';


$conn->close();
// listi
$conn = new mysqli($servername, $username, $password, $dbweapons);
// Check connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql1 = "SELECT * FROM weapons_coins WHERE amount > '0'";
$result1 = $conn->query($sql1);
if(!isset($_POST['guns'])) {
echo '<form method="post" action="'.shopskins.'">';
if ($result->num_rows > 0) {
    // output data of each row
	$select= '<select name="guns">';
	while($row = $result1->fetch_assoc()){
		$id = $row["id"];
		$_SESSION['id'] = $id;
		$weapname = $row["itemname"];
		$price = $row["price"];
	$select.= "<option value='$id'> $weapname - $price </option> ";
}

    }
$select.="</select>";
echo $select;
echo '</br></br>Trade Link: <input type="text" name="link" size="80"><p> get it from here <a href ="https://steamcommunity.com/id/me/tradeoffers/privacy" target="_blank">https://steamcommunity.com/id/me/tradeoffers/privacy</a>';
echo '</br></br><input type="submit" value="GET SKIN" onclick="myFunction()"></form>';}

$conn->close();
$link = filter_var($_POST['link'], FILTER_SANITIZE_URL);
$coins = $_SESSION['waps'];
if(isset($_POST['guns']) && !empty($link)){
	$guns=$_POST['guns'];
	$connweapons = new mysqli($servername, $username, $password, $dbweapons);
	$sqlweapons = "SELECT * FROM weapons_coins WHERE id = $guns";
	$resultweapons = $connweapons->query($sqlweapons);
	if ($result1->num_rows > 0){
		while($row = $resultweapons->fetch_assoc()){
			$weapname1 = $row["itemname"];
			$price1 = $row["price"];
		}
	}
	$namebuy = $steamprofile["personaname"];
	$whobuy = $steamprofile['profileurl'];

	  if ($coins < $price1) {
		   echo '<p><strong>You dont have enough COINS, missing '. abs($coins-$price1) .' </strong>';
		   
	   }
	   else {
				$newcoins = $coins - $price1;
				$_SESSION['waps'] = $newcoins;
				$conn = new mysqli($servername, $username, $password, $dbweapons);
				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);}
				echo '<br> Coins Left: '.$newcoins;
				$sql5 = "UPDATE web_coins SET coins = $newcoins WHERE steamid = $stid";
				$result4 = $conn->query($sql5);
				echo "<br>You purchased: $weapname1, wait for ViKiR to send it to you, max 8h and join WAP Steamgroup so Admin can send you skin without waiting you to accept hes friend invite";
				$conn->close();
				//echo $id;
				$conn = new mysqli($servername, $username, $password, $dbweapons);
				$result = $conn->query("SELECT amount FROM `weapons_coins` WHERE id = ".$_SESSION['id']);
				$row = $result->fetch_row();
				if ($row[0] >=1 ) { 
					$sqlweap = "UPDATE weapons_coins SET amount = amount - 1 WHERE id = $guns";
					$resultweap = $conn->query($sqlweap);
					$conn->close();
					$to = "vitali@weallplay.eu";
					$subject = "CSGO Weapons Buy $namebuy";
					$txt = "$namebuy has purcased gun $weapname1 condition $condition . Link: $whobuy tradelink $link ";
					mail($to,$subject,$txt,$headers);
				}
	   }
}
else {
	echo 'Please select Skin and Enter <strong>TradeLink</strong>';
}

}
else {
	echo 'You have to be VIP to get skins.';
}

}

?>