<?php
include "function.php";
include "bandit.php";
include "bot.php";

$TelegramRawInput = file_get_contents("php://input");

$update = json_decode($TelegramRawInput, TRUE);

if(!$update)
{
  //exit;
}

$MessageObj = $update['message'];
$chatId = $MessageObj['chat']['id'];
$MikeId = "424842427";
$testo = $MessageObj['text'];
$nome =  $MessageObj['from']['first_name'];
$tag =  $MessageObj['from']['username'];
$cacca = "mod";




switch($testo)
{

case 'Fungi':
     $out = sendMsg($botToken,$chatId,"Fungo");
   //  $inlineKB = '[{"text" : "Vai su Google", "url" : "https://www.google.com"},{"text" : "Vai al Blog", "url" : "https://ettoremorettiblog.it"}]';
   // $out = sendMsg($botToken,$chatId,"Invio un messaggio con una inlineKeyboard!",$inlineKB,"inline");
break;

  case '/inline':
    $inlineKB = '[{"text" : "Vai su Google", "url" : "https://www.google.com"},{"text" : "Vai al Blog", "url" : "https://ettoremorettiblog.it"}]';
    $out = sendMsg($botToken,$chatId,"<b>Invio un messaggio con una inlineKeyboard!</b>",$inlineKB,"inline");
  break;
        
}
?>
