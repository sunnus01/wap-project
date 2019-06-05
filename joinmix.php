<?php
$price = 30;
include 'includes/steamauth/userInfo.php';
//Get the steamid (really the community id)
$communityid = $_SESSION['steamid'];
//Get the map name
//See if the second number in the steamid (the auth server) is 0 or 1. Odd is 1, even is 0
$authserver = bcsub($communityid, '76561197960265728') & 1;
//Get the third number of the steamid
$authid = (bcsub($communityid, '76561197960265728')-$authserver)/2;
//Concatenate the STEAM_ prefix and the first number, which is always 0, as well as colons with the other two numbers
$steamidsteam = "STEAM_1:$authserver:$authid";
?>

<div style="position: relative;
	display: block;
    width: 500px;"><br><h2>About WAP-MIX System.</h2>
	<br>You join 5v5 server ( random teams or captains, competitive rules with overtime ) winner team gets points depending on game score 
	(gamescore / 5 if you get gamescore 60 so 60/5 = 12 wap coins). Loser team gets nothing. If you leave match you get no points, and BAN from all WAP servers for 72h, 
	match will continue with substitution (new player may join).
<br><br><br><h3>Join WAP-MIX by clicking WHITELIST ME</h3>
<br>By clicking WHITELIST ME , your IP will be added to server whitelist IP's.
<br>You will be charged <?php echo $price; ?> WAP's.
<br><br>by weallplay.eu ViKiR

<br><br><center><input type="button" value=" WHITELIST ME " onClick="whitelistMe()"></center>
</div>
<script>
	function whitelistMe(){
		var values = {ip: "<?php echo $_SERVER["REMOTE_ADDR"]; ?>",
		price: "<?php echo $price; ?>",
		coins: "<?php echo $_SESSION['waps']; ?>",
		steamidsteam: "<?php echo $steamidsteam; ?>",
		steamid: "<?php echo $_SESSION['steamid']; ?>"}
		$.ajax({
			url: 'whitelistme.php',
			type: 'POST',
			data: values,
			success: function (data) {
			   // you will get response from your php page (what you echo or print)                 
				alert(data);
				window.location.href = "#";
			},
		});
	}
</script>

