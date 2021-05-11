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
  $insertSQL = sprintf("INSERT INTO gt_gifts (gifter, game_id, receiver) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['gifter'], "int"),
                       GetSQLValueString($_POST['game'], "int"),
                       GetSQLValueString($_POST['receiver'], "int"));

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
$query_rcdUser1 = "SELECT * FROM gt_user ORDER BY username ASC";
$rcdUser1 = mysql_query($query_rcdUser1, $gt) or die(mysql_error());
$row_rcdUser1 = mysql_fetch_assoc($rcdUser1);
$totalRows_rcdUser1 = mysql_num_rows($rcdUser1);

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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
	<table align="center">
		<tr valign="baseline">
			<td nowrap="nowrap" align="right">Gifter:</td>
			<td><select name="gifter">
				<option value="=CHOOSE GIFTER=">=CHOOSE GIFTER=</option>
				<?php
do {  
?>
				<option value="<?php echo $row_rcdUser1['id_user']?>"><?php echo $row_rcdUser1['username']?></option>
				<?php
} while ($row_rcdUser1 = mysql_fetch_assoc($rcdUser1));
  $rows = mysql_num_rows($rcdUser1);
  if($rows > 0) {
      mysql_data_seek($rcdUser1, 0);
	  $row_rcdUser1 = mysql_fetch_assoc($rcdUser1);
  }
?>
			</select></td>
		</tr>
		<tr> </tr>
		<tr valign="baseline">
			<td nowrap="nowrap" align="right">Game:</td>
			<td><select name="game">
				<option value="=CHOOSE GAME=">=CHOOSE GAME=</option>
				<?php
do {  
?>
				<option value="<?php echo $row_rcdGame['id_game']?>"><?php echo $row_rcdGame['game']?></option>
				<?php
} while ($row_rcdGame = mysql_fetch_assoc($rcdGame));
  $rows = mysql_num_rows($rcdGame);
  if($rows > 0) {
      mysql_data_seek($rcdGame, 0);
	  $row_rcdGame = mysql_fetch_assoc($rcdGame);
  }
?>
			</select></td>
		</tr>
		<tr> </tr>
		<tr valign="baseline">
			<td nowrap="nowrap" align="right">Receiver:</td>
			<td><select name="receiver">
				<option value="=CHOOSE RECEIVER=">=CHOOSE RECEIVER=</option>
				<?php
do {  
?>
				<option value="<?php echo $row_rcdUser2['id_user2']?>"><?php echo $row_rcdUser2['username2']?></option>
				<?php
} while ($row_rcdUser2 = mysql_fetch_assoc($rcdUser2));
  $rows = mysql_num_rows($rcdUser2);
  if($rows > 0) {
      mysql_data_seek($rcdUser2, 0);
	  $row_rcdUser2 = mysql_fetch_assoc($rcdUser2);
  }
?>
			</select></td>
		</tr>
		<tr> </tr>
		<tr valign="baseline">
			<td nowrap="nowrap" align="right">&nbsp;</td>
			<td><input type="submit" value="Insert record" /></td>
		</tr>
	</table>
	<input type="hidden" name="id_gift" value="" />
	<input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rcdUser1);

mysql_free_result($rcdGame);

mysql_free_result($rcdUser2);
?>
