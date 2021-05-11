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
$query_rcdGifted = "SELECT gt_user.id_user, gt_user.username, COUNT(gt_gifts.gifter) FROM gt_user, gt_gifts WHERE gt_user.id_user = gt_gifts.gifter GROUP BY gt_gifts.gifter ORDER BY COUNT(gt_gifts.gifter) DESC, gt_user.username";
$rcdGifted = mysql_query($query_rcdGifted, $gt) or die(mysql_error());
$row_rcdGifted = mysql_fetch_assoc($rcdGifted);
$totalRows_rcdGifted = mysql_num_rows($rcdGifted);

mysql_select_db($database_gt, $gt);
$query_rcdReceived = "SELECT gt_user.id_user, gt_user.username, COUNT(gt_gifts.receiver) FROM gt_user, gt_gifts WHERE gt_user.id_user = gt_gifts.receiver GROUP BY gt_gifts.receiver ORDER BY COUNT(gt_gifts.receiver) DESC, gt_user.username";
$rcdReceived = mysql_query($query_rcdReceived, $gt) or die(mysql_error());
$row_rcdReceived = mysql_fetch_assoc($rcdReceived);
$totalRows_rcdReceived = mysql_num_rows($rcdReceived);

mysql_select_db($database_gt, $gt);
$query_rcdUsers = "SELECT * FROM gt_user ORDER BY username ASC";
$rcdUsers = mysql_query($query_rcdUsers, $gt) or die(mysql_error());
$row_rcdUsers = mysql_fetch_assoc($rcdUsers);
$totalRows_rcdUsers = mysql_num_rows($rcdUsers);

$urlUserID_rcdUserGifted = "-1";
if (isset($_GET['id'])) {
  $urlUserID_rcdUserGifted = $_GET['id'];
}
mysql_select_db($database_gt, $gt);
$query_rcdUserGifted = sprintf("SELECT * FROM gt_user, gt_game, gt_gifts WHERE gt_user.id_user = %s AND gt_gifts.gifter = %s AND gt_game.id_game = gt_gifts.game_id ORDER BY gt_game.game", GetSQLValueString($urlUserID_rcdUserGifted, "int"),GetSQLValueString($urlUserID_rcdUserGifted, "int"));
$rcdUserGifted = mysql_query($query_rcdUserGifted, $gt) or die(mysql_error());
$row_rcdUserGifted = mysql_fetch_assoc($rcdUserGifted);
$totalRows_rcdUserGifted = mysql_num_rows($rcdUserGifted);

$urlUserID_rcdUserReceived = "-1";
if (isset($_GET['id'])) {
  $urlUserID_rcdUserReceived = $_GET['id'];
}
mysql_select_db($database_gt, $gt);
$query_rcdUserReceived = sprintf("SELECT * FROM gt_user, gt_game, gt_gifts WHERE gt_user.id_user = %s AND gt_gifts.receiver = %s AND gt_game.id_game = gt_gifts.game_id ORDER BY gt_game.game", GetSQLValueString($urlUserID_rcdUserReceived, "int"),GetSQLValueString($urlUserID_rcdUserReceived, "int"));
$rcdUserReceived = mysql_query($query_rcdUserReceived, $gt) or die(mysql_error());
$row_rcdUserReceived = mysql_fetch_assoc($rcdUserReceived);
$totalRows_rcdUserReceived = mysql_num_rows($rcdUserReceived);

$colname_rcdUsername = "-1";
if (isset($_GET['id'])) {
  $colname_rcdUsername = $_GET['id'];
}
mysql_select_db($database_gt, $gt);
$query_rcdUsername = sprintf("SELECT * FROM gt_user WHERE id_user = %s", GetSQLValueString($colname_rcdUsername, "int"));
$rcdUsername = mysql_query($query_rcdUsername, $gt) or die(mysql_error());
$row_rcdUsername = mysql_fetch_assoc($rcdUsername);
$totalRows_rcdUsername = mysql_num_rows($rcdUsername);

$urlUserID_rcdUserRecStat = "-1";
if (isset($_GET['id'])) {
  $urlUserID_rcdUserRecStat = $_GET['id'];
}
mysql_select_db($database_gt, $gt);
$query_rcdUserRecStat = sprintf("SELECT * FROM gt_user, gt_game, gt_gifts, gt_user2 WHERE gt_user.id_user = %s AND gt_gifts.receiver = %s AND gt_game.id_game = gt_gifts.game_id AND gt_user2.id_user2 = gt_gifts.gifter ORDER BY gt_game.game", GetSQLValueString($urlUserID_rcdUserRecStat, "int"),GetSQLValueString($urlUserID_rcdUserRecStat, "int"));
$rcdUserRecStat = mysql_query($query_rcdUserRecStat, $gt) or die(mysql_error());
$row_rcdUserRecStat = mysql_fetch_assoc($rcdUserRecStat);
$totalRows_rcdUserRecStat = mysql_num_rows($rcdUserRecStat);

$urlUserID_rcdUserGiftStat = "-1";
if (isset($_GET['id'])) {
  $urlUserID_rcdUserGiftStat = $_GET['id'];
}
mysql_select_db($database_gt, $gt);
$query_rcdUserGiftStat = sprintf("SELECT * FROM gt_user, gt_game, gt_gifts, gt_user2 WHERE gt_user.id_user = %s AND gt_gifts.gifter = %s AND gt_game.id_game = gt_gifts.game_id AND gt_user2.id_user2 = gt_gifts.receiver ORDER BY gt_game.game", GetSQLValueString($urlUserID_rcdUserGiftStat, "int"),GetSQLValueString($urlUserID_rcdUserGiftStat, "int"));
$rcdUserGiftStat = mysql_query($query_rcdUserGiftStat, $gt) or die(mysql_error());
$row_rcdUserGiftStat = mysql_fetch_assoc($rcdUserGiftStat);
$totalRows_rcdUserGiftStat = mysql_num_rows($rcdUserGiftStat);
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GameTrailers Holiday Steam Gifting (Christmas 2011) - Users</title>
<link href="main.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function toggle2(showHideDiv, switchTextDiv) {
	var ele = document.getElementById(showHideDiv);
	var text = document.getElementById(switchTextDiv);
	if(ele.style.display == "block") {
    		ele.style.display = "none";
		text.innerHTML = "Show Users";
  	}
	else {
		ele.style.display = "block";
		text.innerHTML = "Hide Users";
	}
}
</script>
</head>
<body>
<div class="wrapper">  
<div class="container"><ul class="menu" rel="sam1">  
<li><a href="/">Home</a></li>  
<li><a href="games.php">Games</a></li>  
<li class="active"><a href="users.php">Users</a></li>  
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
	<div id="headerDiv">
		<div id="titleText">Participating Users - <a id="myHeader" href="javascript:toggle2('myContent','myHeader');" >Hide Users</a></div>
	</div>
	<div style="clear:both;"></div>
	<div id="contentDiv">
		<div id="myContent" style="display: block;">
			<p>
				<?php do { ?>
					<div id="userList"><a href="users.php?id=<?php echo $row_rcdUsers['id_user']; ?>"><?php echo $row_rcdUsers['username']; ?></a></div>
				<?php } while ($row_rcdUsers = mysql_fetch_assoc($rcdUsers)); ?>
			</p>
		</div>
	</div>
</div>
<div id="content">
	<p>
	<table width="100%" cellpadding="10">
			<tr align="center">
				<th width="45%">Gifts Sent</th>
				<th width="10%"> - </th>
				<th width="45%">Gifts Received</th>
			</tr>
			<tr>
				<td valign="top">
					<table width="100%" cellpadding="5">
						<?php do { ?>
						<tr>
							<td><?php echo $row_rcdGifted['username']; ?></td>
							<td width="20" align="right"><?php echo $row_rcdGifted['COUNT(gt_gifts.gifter)']; ?></td>
						</tr>
						<?php } while ($row_rcdGifted = mysql_fetch_assoc($rcdGifted)); ?>
					</table>
				</td>
				<td></td>
				<td valign="top">
					<table width="100%" cellpadding="5">
						<?php do { ?>
						<tr>
							<td><?php echo $row_rcdReceived['username']; ?></td>
							<td width="20" align="right"><?php echo $row_rcdReceived['COUNT(gt_gifts.receiver)']; ?></td>
						</tr>
						<?php } while ($row_rcdReceived = mysql_fetch_assoc($rcdReceived)); ?>
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

	if (isset($_GET['id']) == $row_rcdUsername['id_user']) {
?>
<div id="content"><a href="users.php">Return to the User list</a> | <a onClick="history.go(-1);return true;">Go back to previous page</a></div>
<div id="content">
	<table width="100%">
		<tr>
			<th>GT User</th>
			<th align="right" width="140">Total Gifted:&nbsp;&nbsp;</th>
			<td align="center" width="40"><?php echo $totalRows_rcdUserGifted ?></td>
		</tr>
		<tr>
			<td align="center"><?php echo $row_rcdUsername['username']; ?></td>
			<th align="right">Total Received:&nbsp;&nbsp;</th>
			<td align="center"><?php echo $totalRows_rcdUserReceived ?></td>
		</tr>
		<tr>
			<th colspan="3">Games Gifted</th>
		</tr>
		<tr>
			<td colspan="3">
				<?php if ($totalRows_rcdUserGifted == 0) { // Show if recordset empty ?>
					<font color="#FF0000">&nbsp;This user has not gifted any games</font>
				<?php } // Show if recordset empty ?>
				<?php if ($totalRows_rcdUserGifted > 0) { // Show if recordset not empty ?>
					<?php do { ?>
						<a href="#" class="tooltip"><img src="<?php echo $row_rcdUserGifted['pic']; ?>" height="50" /><span><?php echo $row_rcdUserGifted['game']; ?></span></a>				
					<?php } while ($row_rcdUserGifted = mysql_fetch_assoc($rcdUserGifted)); ?>
				<?php } // Show if recordset not empty ?>
				<br /><br />
			</td>
		</tr>
		<tr>
			<th colspan="3">Games Received</th>
		</tr>
		<tr>
			<td colspan="3">
				<?php if ($totalRows_rcdUserReceived == 0) { // Show if recordset empty ?>
					<font color="#FF0000">&nbsp;This user has not received any games</font>
				<?php } // Show if recordset empty ?>
				<?php if ($totalRows_rcdUserReceived > 0) { // Show if recordset not empty ?>
					<?php do { ?>
						<a href="#" class="tooltip"><img src="<?php echo $row_rcdUserReceived['pic']; ?>" height="50" /><span><?php echo $row_rcdUserReceived['game']; ?></span></a>				
					<?php } while ($row_rcdUserReceived = mysql_fetch_assoc($rcdUserReceived)); ?>
				<?php } // Show if recordset not empty ?>
			</td>
		</tr>
	</table>
</div>
<div id="content">
	<p>
		<table width="100%">
			<tr>
				<th width="50%">Gifted</th>
				<th width="50%">Received</th>
			</tr>
			<tr>
				<td valign="top">
					<table width="100%">
<?php do { ?>
						<tr>
							<td><img src="<?php echo $row_rcdUserGiftStat['pic']; ?>" align="left" height="36" />&nbsp;&nbsp;<a href="games.php?id=<?php echo $row_rcdUserGiftStat['game_id']; ?>"><strong><?php echo $row_rcdUserGiftStat['game']; ?></strong></a> was gifted to<br />&nbsp;&nbsp;<a href="users.php?id=<?php echo $row_rcdUserGiftStat['id_user2']; ?>"><strong><?php echo $row_rcdUserGiftStat['username2']; ?></strong></a></td>
						</tr>
<?php } while ($row_rcdUserGiftStat = mysql_fetch_assoc($rcdUserGiftStat)); ?>
					</table>
				</td>
				<td valign="top">
					<table width="100%">
<?php do { ?>
						<tr>
							<td><img src="<?php echo $row_rcdUserRecStat['pic']; ?>" align="left" height="36" />&nbsp;&nbsp;<a href="games.php?id=<?php echo $row_rcdUserRecStat['game_id']; ?>"><strong><?php echo $row_rcdUserRecStat['game']; ?></strong></a> was gifted from<br />&nbsp;&nbsp;<a href="users.php?id=<?php echo $row_rcdUserRecStat['id_user2']; ?>"><strong><?php echo $row_rcdUserRecStat['username2']; ?></strong></a></td>
						</tr>
<?php } while ($row_rcdUserRecStat = mysql_fetch_assoc($rcdUserRecStat)); ?>
					</table>
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
mysql_free_result($rcdGifted);

mysql_free_result($rcdReceived);

mysql_free_result($rcdUsers);

mysql_free_result($rcdUserGifted);

mysql_free_result($rcdUserReceived);

mysql_free_result($rcdUsername);

mysql_free_result($rcdUserRecStat);

mysql_free_result($rcdUserGiftStat);
?>
