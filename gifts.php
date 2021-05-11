<?php //require_once('Connections/gt.php'); ?>
<?php
/****************/
/* Legacy MySQL */
/****************/
/*
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
	if (PHP_VERSION < 6) {
		$theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
	}

	$theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

	switch ($theType) {
		case "text":
			$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
			break;    
		case "long":
		case "int":
			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			break;
		case "double":
			$theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
			break;
		case "date":
			$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
			break;
		case "defined":
			$theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
			break;
	}
	return $theValue;
}
}

mysql_select_db($database_gt, $gt);
$query_rcdGifts = "SELECT * FROM gt_gifts, gt_game, gt_user, gt_user2 WHERE gt_game.id_game = gt_gifts.game_id AND gt_user.id_user = gt_gifts.gifter AND gt_user2.id_user2 = gt_gifts.receiver ORDER BY gt_user.username, gt_game.game, gt_user2.username2";
$rcdGifts = mysql_query($query_rcdGifts, $gt) or die(mysql_error());
$row_rcdGifts = mysql_fetch_assoc($rcdGifts);
$totalRows_rcdGifts = mysql_num_rows($rcdGifts);
*/

try {
	require_once('Connections/gt.php');
	$queryGifts = "SELECT * FROM gt_gifts, gt_game, gt_user, gt_user2 WHERE gt_game.id_game = gt_gifts.game_id AND gt_user.id_user = gt_gifts.gifter AND gt_user2.id_user2 = gt_gifts.receiver ORDER BY gt_user.username, gt_game.game, gt_user2.username2";
	$gifts = $pdo->prepare($queryGifts);
	$gifts->execute();
	$rowGifts = $gifts->fetchAll();
	$totalGifts = $gifts->rowCount();
} catch(PDOException $error) {
	echo $error->getMessage();
	die();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GameTrailers Holiday Steam Gifting (Christmas 2011) - Gifts Sent</title>
<link href="main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="wrapper">  
<div class="container"><ul class="menu" rel="sam1">  
<li><a href="/">Home</a></li>  
<li><a href="games.php">Games</a></li>  
<li><a href="users.php">Users</a></li>  
<li class="active"><a href="gifts.php">Gifts</a></li>  
<li><a href="stats.php">Stats</a></li>  
<li><a href="#">FAQs</a></li>  
</ul>  
</div>  
</div>
<div id="heading">GameTrailers Holiday Steam Gifting (Christmas 2011)</div>
<div id="content">
	<p>
		<table width="100%" cellpadding="10">
			<tr align="center">
				<th width="30%"><u>Gifter</u></th>
				<th width="40%"><u>Game Gifted</u></th>
				<th width="30%"><u>Receiver</u></th>
			</tr>
			<?php foreach ($rowGifts as $rowGift) { ?>
			<tr align="center">
				<td valign="top"><?php echo $rowGift['username']; ?></td>
				<td valign="top"><a class="tooltip" href="#"><img src="<?php echo $rowGifts['pic']; ?>" height="50" /><span><?php echo $rowGift['game']; ?></span></a></td>
				<td valign="top"><?php echo $rowGift['username2']; ?></td>
			</tr>
			<?php } ?>
		</table>
	</p>
</div>
<div id="content">
	<p align="center">Web site programmed and designed by Aaron Varshney.</p>
	<p align="center">2011 &copy; Aaron Varshney.</p></div>
</body>
</html>
<?php
// mysql_free_result($gifts);
?>
