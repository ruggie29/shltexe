<?php

include "function.php";

 $cacca = 'cacca';

if(stristr($testo, $cacca) !== FALSE)
{
  $out = sendMsg($botToken,$chatId,"Vai in bagno");
}
?>
