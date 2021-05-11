<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_gt = "localhost";
$database_gt = "vw_site";
$username_gt = "vw_varsh";
$password_gt = "~S@kurA1981~";
$gt = mysql_pconnect($hostname_gt, $username_gt, $password_gt) or trigger_error(mysql_error(),E_USER_ERROR); 
?>