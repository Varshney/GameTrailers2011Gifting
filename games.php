<?php require_once('Connections/gt.php'); ?>
<?php
// if (!function_exists("GetSQLValueString")) {
// 	function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") {
// 		if (PHP_VERSION < 6) {
// 			$theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
// 		}

// 		$theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

// 		switch ($theType) {
// 			case "text":
// 				$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
// 				break;
// 			case "long":
// 			case "int":
// 				$theValue = ($theValue != "") ? intval($theValue) : "NULL";
// 				break;
// 			case "double":
// 				$theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
// 				break;
// 			case "date":
// 				$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
// 				break;
// 			case "defined":
// 				$theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
// 				break;
// 		}
// 		return $theValue;
// 	}
// }

$currentPage = $_SERVER["PHP_SELF"];

/************************/
/* Legacy MySQL queries */
/************************/
/*
mysql_select_db($database_gt, $gt);
$query_rcdGiftedGames = "SELECT *, COUNT(gt_game.game) FROM gt_game, gt_gifts WHERE gt_gifts.game_id = gt_game.id_game GROUP BY gt_gifts.game_id ORDER BY gt_game.game";
$rcdGiftedGames = mysql_query($query_rcdGiftedGames, $gt) or die(mysql_error());
$row_rcdGiftedGames = mysql_fetch_assoc($rcdGiftedGames);
$totalRows_rcdGiftedGames = mysql_num_rows($rcdGiftedGames);

mysql_select_db($database_gt, $gt);
$query_rcdTotalGifts = "SELECT id_gift FROM gt_gifts";
$rcdTotalGifts = mysql_query($query_rcdTotalGifts, $gt) or die(mysql_error());
$row_rcdTotalGifts = mysql_fetch_assoc($rcdTotalGifts);
$totalRows_rcdTotalGifts = mysql_num_rows($rcdTotalGifts);

mysql_select_db($database_gt, $gt);
$query_rcdGiftedGamesDesc = "SELECT *, COUNT(gt_game.game) FROM gt_game, gt_gifts WHERE gt_gifts.game_id = gt_game.id_game GROUP BY gt_gifts.game_id ORDER BY COUNT(gt_game.game) DESC, gt_game.game ASC";
$rcdGiftedGamesDesc = mysql_query($query_rcdGiftedGamesDesc, $gt) or die(mysql_error());
$row_rcdGiftedGamesDesc = mysql_fetch_assoc($rcdGiftedGamesDesc);
$totalRows_rcdGiftedGamesDesc = mysql_num_rows($rcdGiftedGamesDesc);

$urlGameID_rcdGames = "-1";
if (isset($_GET['id'])) {
  $urlGameID_rcdGames = $_GET['id'];
}
mysql_select_db($database_gt, $gt);
$query_rcdGames = sprintf("SELECT * FROM gt_game, gt_gifts, gt_user WHERE id_game = %s AND gt_gifts.game_id = %s AND gt_user.id_user = gt_gifts.receiver ORDER BY gt_user.username", GetSQLValueString($urlGameID_rcdGames, "int"),GetSQLValueString($urlGameID_rcdGames, "int"));
$rcdGames = mysql_query($query_rcdGames, $gt) or die(mysql_error());
$row_rcdGames = mysql_fetch_assoc($rcdGames);
$totalRows_rcdGames = mysql_num_rows($rcdGames);

$queryString_rcdGiftedGames = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
	if (stristr($param, "pageNum_rcdGiftedGames") == false && 
		stristr($param, "totalRows_rcdGiftedGames") == false) {
	  array_push($newParams, $param);
	}
  }
  if (count($newParams) != 0) {
	$queryString_rcdGiftedGames = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rcdGiftedGames = sprintf("&totalRows_rcdGiftedGames=%d%s", $totalRows_rcdGiftedGames, $queryString_rcdGiftedGames);
*/

/////////////////////////////////////
// Updated MySQL queries using PDO //
/////////////////////////////////////

// Get a list of the games gifted
try {
	$queryGiftedGames = "SELECT *, COUNT(gt_game.game) FROM gt_game, gt_gifts WHERE gt_gifts.game_id = gt_game.id_game GROUP BY gt_gifts.game_id ORDER BY gt_game.game";
	$giftedGames = $pdo->prepare($queryGiftedGames);
	$giftedGames->execute();
	$rowGiftedGames = $giftedGames->fetchAll();
	$totalGiftedGames = $giftedGames->rowCount();
} catch (PDOException $error) {
	echo $error;
}

// Get a list of the games gifted in descending order
try {
	$queryGiftedGamesDesc = "SELECT *, COUNT(gt_game.game) FROM gt_game, gt_gifts WHERE gt_gifts.game_id = gt_game.id_game GROUP BY gt_gifts.game_id ORDER BY COUNT(gt_game.game) DESC, gt_game.game ASC";
	$giftedGamesDesc = $pdo->prepare($queryGiftedGamesDesc);
	$giftedGamesDesc->execute();
	$rowGiftedGamesDesc = $giftedGamesDesc->fetchAll();
	$totalGiftedGamesDesc = $giftedGamesDesc->rowCount();
} catch (PDOException $error) {
	echo $error;
}

// Get a count of the total gifts given
try {
	$queryTotalGifts = "SELECT id_gift FROM gt_gifts";
	$totalGifts = $pdo->prepare($queryTotalGifts);
	$totalGifts->execute();
	$rowTotalGifts = $totalGifts->fetchAll();
	$totalTotalGifts = $totalGifts->rowCount();
} catch (PDOException $error) {
	echo $error;
}

$urlGameID_rcdGames = "-1";
if (isset($_GET['id'])) {
  $urlGameID_rcdGames = $_GET['id'];
}

try {
	$queryGames = sprintf("SELECT * FROM gt_game, gt_gifts, gt_user WHERE id_game = %s AND gt_gifts.game_id = %s AND gt_user.id_user = gt_gifts.receiver ORDER BY gt_user.username", $urlGameID_rcdGames, $urlGameID_rcdGames);
	$games = $pdo->prepare($queryGames);
	$games->execute();
	$rowGames = $games->fetchAll();
	$totalRowGames = $games->rowCount();
	// var_dump($rowGames);
} catch(PDOException $error) {
	echo $error;
}

// $queryString_rcdGiftedGames = "";
// if (!empty($_SERVER['QUERY_STRING'])) {
//   $params = explode("&", $_SERVER['QUERY_STRING']);
//   $newParams = array();
//   foreach ($params as $param) {
// 	if (stristr($param, "pageNum_rcdGiftedGames") == false && 
// 		stristr($param, "totalRows_rcdGiftedGames") == false) {
// 	  array_push($newParams, $param);
// 	}
//   }
//   if (count($newParams) != 0) {
// 	$queryString_rcdGiftedGames = "&" . htmlentities(implode("&", $newParams));
//   }
// }
// $queryString_rcdGiftedGames = sprintf("&totalRows_rcdGiftedGames=%d%s", $totalRows_rcdGiftedGames, $queryString_rcdGiftedGames);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GameTrailers Holiday Steam Gifting (Christmas 2011) - Games Gifted</title>
<link href="main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="wrapper">  
<div class="container"><ul class="menu" rel="sam1">  
<li><a href="/">Home</a></li>  
<li class="active"><a href="games.php">Games</a></li>  
<li><a href="users.php">Users</a></li>  
<li><a href="gifts.php">Gifts</a></li>  
<li><a href="stats.php">Stats</a></li>  
<li><a href="#">FAQs</a></li>  
</ul>  
</div>  
</div>
<div id="heading">GameTrailers Holiday Steam Gifting (Christmas 2011)</div>
<?php
	if (!isset($_GET['id'])) {
?>
<div id="content">
	<p>
		<table width="100%">
			<tr>
				<td width="50%">
					<table width="100%" cellpadding="10">
						<tr valign="top">
							<th width="150">Total: <?php echo $totalTotalGifts; ?></th>
							<th>Game Name<br />
							(A-Z)</th>
							<th width="30">Gifted</th>
						</tr>
						<?php foreach ($rowGiftedGames as $giftedGames) { ?>
						<tr>
							<td align="center"><img src="<?php echo $giftedGames['pic']; ?>" height="40" /></td>
							<td><a href="games.php?id=<?php echo $giftedGames['id_game']; ?>"><?php echo $giftedGames['game']; ?></a></td>
							<td align="center"><?php echo $giftedGames['COUNT(gt_game.game)']; ?></td>
						</tr>
						<?php } ?>
					</table>
				</td>
				<td width="50%">
					<table width="100%" cellpadding="10">
						<tr valign="top">
							<th width="150">Total: <?php echo $totalTotalGifts ?></th>
							<th>Game Name</th>
							<th width="30">Gifted (top)</th>
						</tr>
						<?php foreach ($rowGiftedGamesDesc as $giftedGamesDesc) { ?>
						<tr>
							<td align="center"><img src="<?php echo $giftedGamesDesc['pic']; ?>" height="40" /></td>
							<td><a href="games.php?id=<?php echo $giftedGamesDesc['id_game']; ?>"><?php echo $giftedGamesDesc['game']; ?></a></td>
							<td align="center"><?php echo $giftedGamesDesc['COUNT(gt_game.game)']; ?></td>
						</tr>
						<?php } ?>
					</table>
				</td>
			</tr>
		</table>
	</p>
</div>
<?php
	} else

	/*********************************/
	/* Show or hide the User content */
	/*********************************/

	if (isset($_GET['id'])) {
?>
<div id="content"><a href="games.php">Return to the Games list</a> | <a onClick="history.go(-1);return true;">Go back to previous page</a></div>
<div id="content">
	<p>
		<table width="100%">
			<tr valign="top">
				<td width="10%"><img src="<?php echo $game['pic']; ?>" align="left" /></td>
				<td width="90%">
					<?php foreach ($rowGames as $game) { ?>
						<div id="userList"><a href="users.php?id=<?php echo $game['id_user']; ?>"><?php echo $game['username']; ?></a></div>
					<?php } ?>
				</td>
			</tr>
		</table>
		
	</p>
</div>
<?php } ?>
<div id="content">
	<p align="center">Web site programmed and designed by Aaron Varshney.</p>
	<p align="center">2011 &copy; Aaron Varshney.</p>
</div>
</body>
</html>
<?php
	$giftedGames = NULL;
	$totalGifts = NULL;
	$giftedGamesDesc = NULL;
	$games = NULL;
?>
