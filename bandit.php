<?php

$cacca = "mod";

if(stristr($testo, $cacca) !== FALSE)
{
  $out = sendMsg($botToken,$chatId,"Vai in bagno");
}
?>
