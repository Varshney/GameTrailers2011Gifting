<?php require_once('Connections/gt.php'); ?>
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

mysql_select_db($database_gt, $gt);
$query_rcdGifts = "SELECT gift.username AS gift, gt_game.game, rec.username AS rec FROM gt_gifts INNER JOIN gt_user AS gift ON gift.id_user = gt_gifts.gifter INNER JOIN gt_game ON gt_game.id_game = gt_gifts.game_id INNER JOIN gt_user AS rec ON rec.id_user = gt_gifts.receiver ORDER BY gift, gt_game.game, rec";
$rcdGifts = mysql_query($query_rcdGifts, $gt) or die(mysql_error());
$row_rcdGifts = mysql_fetch_assoc($rcdGifts);
$totalRows_rcdGifts = mysql_num_rows($rcdGifts);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<table>
	<tr>
		<th>Gifter</th>
		<th>Game</th>
		<th>Receiver</th>
	</tr>
	<?php do { ?>
	<tr>
		<td><?php echo $row_rcdGifts['gift']; ?></td>
		<td><?php echo $row_rcdGifts['game']; ?></td>
		<td><?php echo $row_rcdGifts['rec']; ?></td>
	</tr>
	<?php } while ($row_rcdGifts = mysql_fetch_assoc($rcdGifts)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($rcdGifts);
?>
