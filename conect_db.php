<?php

$Setup_Server = 'https://www.banpayapraischool.ac.th';
$Setup_User = 'banpayap_qlf';
$Setup_Pwd = 'l6-lyo9N';
$Setup_Database = 'banpayap_qlf';

mysql_connect($Setup_Server,$Setup_User,$Setup_Pwd);
mysql_query("use $Setup_Database");
mysql_query("SET NAMES UTF8");

?>
