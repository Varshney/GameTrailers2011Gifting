<?php require_once('Connections/gt.php'); ?>
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
$query_rcdGames = "SELECT id_game FROM gt_game";
$rcdGames = mysql_query($query_rcdGames, $gt) or die(mysql_error());
$row_rcdGames = mysql_fetch_assoc($rcdGames);
$totalRows_rcdGames = mysql_num_rows($rcdGames);

mysql_select_db($database_gt, $gt);
$query_rcdUsers = "SELECT id_user FROM gt_user";
$rcdUsers = mysql_query($query_rcdUsers, $gt) or die(mysql_error());
$row_rcdUsers = mysql_fetch_assoc($rcdUsers);
$totalRows_rcdUsers = mysql_num_rows($rcdUsers);

mysql_select_db($database_gt, $gt);
$query_rcdGifts = "SELECT id_gift FROM gt_gifts";
$rcdGifts = mysql_query($query_rcdGifts, $gt) or die(mysql_error());
$row_rcdGifts = mysql_fetch_assoc($rcdGifts);
$totalRows_rcdGifts = mysql_num_rows($rcdGifts);
*/

try {
	$query_rcdGames = "SELECT id_game FROM gt_game";
	$rcdGames = $pdo->prepare($query_rcdGames);
	$rcdGames->execute();
	$row_rcdGames = $rcdGames->fetchAll();
	$totalRows_rcdGames = $rcdGames->rowCount();
} catch(PDOException $error) {
	echo $error->getMessage();
	die();
}

try {
	$query_rcdUsers = "SELECT id_user FROM gt_user";
	$rcdUsers = $pdo->prepare($query_rcdUsers);
	$rcdUsers->execute();
	$row_rcdUsers = $rcdUsers->fetchAll();
	$totalRows_rcdUsers = $rcdUsers->rowCount();
} catch(PDOException $error) {
	echo $error->getMessage();
	die();
}

try {
	$query_rcdGifts = "SELECT id_gift FROM gt_gifts";
	$rcdGifts = $pdo->prepare($query_rcdGifts);
	$rcdGifts->execute();
	$row_rcdGifts = $rcdGifts->fetchAll();
	$totalRows_rcdGifts = $rcdGifts->rowCount();
} catch(PDOException $error) {
	echo $error->getMEssage();
	die();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GameTrailers Holiday Steam Gifting (Christmas 2011) - Statistics</title>
<link href="main.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="wrapper">  
<div class="container"><ul class="menu" rel="sam1">  
<li><a href="/">Home</a></li>  
<li><a href="games.php">Games</a></li>  
<li><a href="users.php">Users</a></li>  
<li><a href="gifts.php">Gifts</a></li>  
<li class="active"><a href="stats.php">Stats</a></li>  
<li><a href="#">FAQs</a></li>  
</ul>  
</div>  
</div>
<div id="heading">GameTrailers Holiday Steam Gifting (Christmas 2011)</div>
<table border="1">
	<tr>
		<td>Gifts Received</td>
		<td><?php echo $totalRows_rcdGifts ?></td>
	</tr>
	<tr>
		<td>Users Participated</td>
		<td><?php echo $totalRows_rcdUsers ?></td>
	</tr>
	<tr>
		<td>Different Games Gifted</td>
		<td><?php echo $totalRows_rcdGames ?></td>
	</tr>
</table>
</body>
</html>
<?php
	$rcdGames = NULL;
	$rcdUsers = NULL;
	$rcdGifts = NULL;
?>
