<?php
require 'includes/configg123.php';
if(isset($_POST['ip'])){
$ip = $_POST['ip']; // Not in use anymore, coz of Dynamics working with new var $steamidsteam
$price = $_POST['price'];
$steamid = $_POST['steamid'];
$coins = $_POST['coins'];
$steamidsteam = $_POST['steamidsteam'];
}
// adding whitelist to server
	require __DIR__ . '/SourceQuery/bootstrap.php';

	use xPaw\SourceQuery\SourceQuery;
	
	// Check coins
if ($coins < $price){
	echo "You need $price WAPs to whitelist, your WAPs are $coins";
}
else if ($coins >= $price){
	$left = $coins - $price;
	$conn = new mysqli($servername, $username, $password, $dbweapons);
		$sql1 = "UPDATE web_coins SET coins = coins - $price, whitelisted = '1' WHERE steamid = $steamid";
		$result = $conn->query($sql1);
		$conn->close();
		whitelistMe($rconpass);
		echo "You may now join server! Your SteamID is now whitelisted. $left WAPs left";


}
function whitelistMe($rconpass) {
	// Edit this ->
	define( 'SQ_SERVER_ADDR', 'weallplay.eu' );
	define( 'SQ_SERVER_PORT', 27060 );
	define( 'SQ_TIMEOUT',     10 );
	define( 'SQ_ENGINE',      SourceQuery::SOURCE );
	// Edit this <-
	
	$Query = new SourceQuery( );
	
	try
	{
		$Query->Connect( SQ_SERVER_ADDR, SQ_SERVER_PORT, SQ_TIMEOUT, SQ_ENGINE );
		
		$Query->SetRconPassword( $rconpass );
		$Query->Rcon( 'sm_whitelist_add "'.$_POST['steamidsteam'].'"' );
		$Query->Rcon( 'sm_whitelist_reload' );

	}
	catch( Exception $e )
	{
		echo $e->getMessage( );
	}
	finally
	{
		$Query->Disconnect( );
	}
//echo '<pre>';
//echo readfile("/home/csgopug/serverfiles/csgo/addons/sourcemod/configs/whitelist/whitelist.txt");
//echo '</pre>';
	}


?>
