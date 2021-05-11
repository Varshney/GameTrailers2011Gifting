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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE gt_game SET game=%s, pic=%s WHERE id_game=%s",
                       GetSQLValueString($_POST['game'], "text"),
                       GetSQLValueString($_POST['pic'], "text"),
                       GetSQLValueString($_POST['id_game'], "int"));

  mysql_select_db($database_gt, $gt);
  $Result1 = mysql_query($updateSQL, $gt) or die(mysql_error());

  $updateGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_rcdGame = "-1";
if (isset($_GET['id_game'])) {
  $colname_rcdGame = $_GET['id_game'];
}
mysql_select_db($database_gt, $gt);
$query_rcdGame = sprintf("SELECT * FROM gt_game WHERE id_game = %s", GetSQLValueString($colname_rcdGame, "int"));
$rcdGame = mysql_query($query_rcdGame, $gt) or die(mysql_error());
$row_rcdGame = mysql_fetch_assoc($rcdGame);
$colname_rcdGame = "-1";
if (isset($_GET['id'])) {
  $colname_rcdGame = $_GET['id'];
}
mysql_select_db($database_gt, $gt);
$query_rcdGame = sprintf("SELECT * FROM gt_game WHERE id_game = %s", GetSQLValueString($colname_rcdGame, "int"));
$rcdGame = mysql_query($query_rcdGame, $gt) or die(mysql_error());
$row_rcdGame = mysql_fetch_assoc($rcdGame);
$totalRows_rcdGame = mysql_num_rows($rcdGame);
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
			<td nowrap="nowrap" align="right">Id_game:</td>
			<td><?php echo $row_rcdGame['id_game']; ?></td>
		</tr>
		<tr valign="baseline">
			<td nowrap="nowrap" align="right">Game:</td>
			<td><input type="text" name="game" value="<?php echo htmlentities($row_rcdGame['game'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
		</tr>
		<tr valign="baseline">
			<td nowrap="nowrap" align="right">Pic:</td>
			<td><input type="text" name="pic" value="<?php echo htmlentities($row_rcdGame['pic'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
		</tr>
		<tr valign="baseline">
			<td nowrap="nowrap" align="right">&nbsp;</td>
			<td><input type="submit" value="Update record" /></td>
		</tr>
	</table>
	<input type="hidden" name="MM_update" value="form1" />
	<input type="hidden" name="id_game" value="<?php echo $row_rcdGame['id_game']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rcdGame);
?>
