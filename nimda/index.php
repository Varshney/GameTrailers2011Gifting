<?php require_once('../Connections/gt.php'); ?>
<?php
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO gt_user (username) VALUES (%s)",
                       GetSQLValueString($_POST['username'], "text"));

  mysql_select_db($database_gt, $gt);
  $Result1 = mysql_query($insertSQL, $gt) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO gt_user2 (username2) VALUES (%s)",
                       GetSQLValueString($_POST['username'], "text"));

  mysql_select_db($database_gt, $gt);
  $Result1 = mysql_query($insertSQL, $gt) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO gt_game (game, pic) VALUES (%s, %s)",
                       GetSQLValueString($_POST['game'], "text"),
                       GetSQLValueString($_POST['game'], "text"));

  mysql_select_db($database_gt, $gt);
  $Result1 = mysql_query($insertSQL, $gt) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_gt, $gt);
$query_rcdUser = "SELECT * FROM gt_user ORDER BY username ASC";
$rcdUser = mysql_query($query_rcdUser, $gt) or die(mysql_error());
$row_rcdUser = mysql_fetch_assoc($rcdUser);
$totalRows_rcdUser = mysql_num_rows($rcdUser);

mysql_select_db($database_gt, $gt);
$query_rcdGame = "SELECT * FROM gt_game ORDER BY game ASC";
$rcdGame = mysql_query($query_rcdGame, $gt) or die(mysql_error());
$row_rcdGame = mysql_fetch_assoc($rcdGame);
$totalRows_rcdGame = mysql_num_rows($rcdGame);

mysql_select_db($database_gt, $gt);
$query_rcdUser2 = "SELECT * FROM gt_user2 ORDER BY username2 ASC";
$rcdUser2 = mysql_query($query_rcdUser2, $gt) or die(mysql_error());
$row_rcdUser2 = mysql_fetch_assoc($rcdUser2);
$totalRows_rcdUser2 = mysql_num_rows($rcdUser2);

mysql_select_db($database_gt, $gt);
$query_rcdGift = "SELECT * FROM gt_gifts, gt_game, gt_user, gt_user2 WHERE gt_game.id_game = gt_gifts.game_id AND gt_user.id_user = gt_gifts.gifter AND gt_user2.id_user2 = gt_gifts.receiver ORDER BY gt_user.username, gt_game.game, gt_user2.username2";
$rcdGift = mysql_query($query_rcdGift, $gt) or die(mysql_error());
$row_rcdGift = mysql_fetch_assoc($rcdGift);
$totalRows_rcdGift = mysql_num_rows($rcdGift);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css"></style></head>

<body>
<p><strong><font size="+3" color="#FF0000">Everything now works except that I haven't added the edit function for the Users and Gifts. Feel free to keep on adding. :)</font></strong></p>
<p><strong><font size="+3" color="#FF0000">I'll be working on the frontpage from now on and come back to the editing portion some time Friday/Saturday.</font></strong></p>
<p><strong><font size="+3" color="#FF0000">Just a pointer, please delete the gift before the user though later if you delete a user they will instead be labelled as &quot;banned&quot; if they're not playing nice so that the others still get credited.<!-- I'm now adding the option for editing or deleting the users.--></font></strong>
</p>
<hr />
Games &gt;&gt; <a href="addGame.php"></a> - Open All<br />
Gifts &gt;&gt; <a href="addGift.php">Add</a> - Open All
<hr />
<table width="100%" border="1">
	<tr>
		<td width="33%">Usernames</td>
		<td width="34%">Games</td>
		<td width="33%">Gifts</td>
	</tr>
	<tr>
		<td valign="top">
		
		
<p>Add User</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
	<table align="center">
		<tr valign="baseline">
			<td nowrap="nowrap" align="right">Username:</td>
			<td><input type="text" name="username" value="Add a name" size="32" /></td>
		</tr>
		<tr valign="baseline">
			<td nowrap="nowrap" align="right">&nbsp;</td>
			<td><input type="submit" value="Insert record" /></td>
		</tr>
	</table>
	<input type="hidden" name="id_user" value="<?php echo $row_rcdUser['id_user']; ?>" />
	<input type="hidden" name="MM_insert" value="form1" />
</form>



<!-- User Table Start -->
	<table width="100%" border="1">
		<tr>
			<td>ID</td>
			<td>Name</td>
			<td>&nbsp;</td>
		</tr>
<?php do { ?>
		<tr>
			<td><?php echo $row_rcdUser['id_user']; ?></td>
			<td><?php echo $row_rcdUser['username']; ?></td>
			<td>Edit<br />
				<a href="delUser.php?id=<?php echo $row_rcdUser['id_user']; ?>">Delete</a></td>
		</tr>
<?php } while ($row_rcdUser = mysql_fetch_assoc($rcdUser)); ?>
	</table>
<!-- User Table End -->
	
	
	
		</td>
		<td valign="top">
		
		
<p>Add Game</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
	<table align="center">
		<tr valign="baseline">
			<td nowrap="nowrap" align="right">Game:</td>
			<td><input type="text" name="game" value="Add a game" size="32" /></td>
		</tr>
		<tr valign="baseline">
			<td nowrap="nowrap" align="right">&nbsp;</td>
			<td><input type="submit" value="Insert record" /></td>
		</tr>
	</table>
	<input type="hidden" name="id_game" value="<?php echo $row_rcdGame['id_game']; ?>" />
	<input type="hidden" name="pic" value="<?php echo $row_rcdGame['game']; ?>" />
	<input type="hidden" name="MM_insert" value="form2" />
</form>



<!-- Games Table Start -->
	<table width="100%" border="1">
		<tr>
			<td>ID</td>
			<td>Image</td>
			<td>Name</td>
			<td>&nbsp;</td>
		</tr>
<?php do { ?>
		<tr>
			<td><?php echo $row_rcdGame['id_game']; ?></td>
			<td><img src="<?php echo $row_rcdGame['pic']; ?>" height="50" /></td>
			<td><?php echo $row_rcdGame['game']; ?></td>
			<td><a href="editGame.php?id=<?php echo $row_rcdGame['id_game']; ?>">Edit</a><br />
				<a href="delGame.php?id=<?php echo $row_rcdGame['id_game']; ?>">Delete</a></td>
		</tr>
<?php } while ($row_rcdGame = mysql_fetch_assoc($rcdGame)); ?>
	</table>
<!-- Games Table End -->
		
		
		</td>
		<td valign="top">
		
		
		
<table width="100%" border="1">
	<tr>
		<td width="25%">Gifter</td>
		<td width="25%">Game</td>
		<td width="25%">Receiver</td>
		<td width="25%">&nbsp;</td>
	</tr>
		<?php if ($totalRows_rcdGift > 0) { // Show if recordset not empty ?>
	<?php do { ?>
	<tr>
	<td><?php echo $row_rcdGift['gifter']; ?> - <?php echo $row_rcdGift['username']; ?></td>
			<td><?php echo $row_rcdGift['game_id']; ?> - <!--<img src="<?php //echo $row_rcdGift['pic']; ?>" height="50" />--><?php echo $row_rcdGift['game']; ?></td>
			<td><?php echo $row_rcdGift['receiver']; ?> - <?php echo $row_rcdGift['username2']; ?></td>
			<td>Edit<br /><a href="delGift.php?id=<?php echo $row_rcdGift['id_gift']; ?>">Delete</a></td>
	</tr>
	<?php } while ($row_rcdGift = mysql_fetch_assoc($rcdGift)); ?>
			<?php } // Show if recordset not empty ?>
</table>
<?php if ($totalRows_rcdGift == 0) { // Show if recordset empty ?>
	There are currently no gifts added.
	<?php } // Show if recordset empty ?></td>
	</tr>
</table>
</body>
</html>
<?php
mysql_free_result($rcdUser);

mysql_free_result($rcdGame);

mysql_free_result($rcdGift);

mysql_free_result($rcdUser2);
?>
