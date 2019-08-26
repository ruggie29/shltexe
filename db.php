<?php
//mysql_connect('ftp.rug.altervista.org','rug','2ZbmqKxaxpsm');
//mysql_select_db('my_rug')
$host = "localhost";
$username = "rug";
$password = "2ZbmqKxaxpsm";
$database = "my_rug";
  
$db = mysql_connect($host, $username, $password) or die("Errore durante la connessione al database");
mysql_select_db($database, $db) or die("Errore durante la selezione del database"); 

?>
