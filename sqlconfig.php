<?php
$host = "localhost";  
$us = "root";  
$pw = "root";  
$db = "scala_tasklist";  
     
$con = mysql_connect($host,$us,$pw)or die ("Could not connect to MySQL");  
mysql_select_db($db)or die ("Could not connect to Database");

$sql="CREATE TABLE `todo_list` (
  `Task_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Task_Subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Task_Detail` text COLLATE utf8_unicode_ci NOT NULL,
  `Task_Status` int(11) NOT NULL,
	PRIMARY KEY(`Task_Id`))ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";


if (mysql_query($sql))
{
  //echo "Table location created successfully";
  
  
}

?>