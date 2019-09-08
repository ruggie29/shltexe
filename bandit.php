<?php

 $cacca = 'cacca';

if(stristr($Globals[$testo], $cacca) !== FALSE)
{
  $out = sendMsg($botToken,$chatId,"Vai in bagno");
}
?>
