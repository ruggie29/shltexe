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

$query = $update['callback_query'];
$queryid = $query['id'];
$queryuser = $query['from']['id'];
$querydata = $query['data'];

if($querydata = "povero")
{
  $out = sendMsg($botToken,$queryuser,"<b>Cazzo pulli che sei povero?!</b>");
  //$inline2 = '[{"text" : "<<Indietro", "callback_data" : "back"},{"text" : "Dove Pullare", "callback_data" : "povero"}]';
  //$out = sendMsg($botToken,$queryuser,"Cazzo pulli che sei povero?",$inline2,"inline");
}

if($querydata = "back")
{
  
    $inline2 = '[{"text" : "Vai su Google", "url" : "https://www.google.com"},{"text" : "Dove Pullare", "callback_data" : "no"}]';
    $out = sendMsg($botToken,$queryuser,"Sono tornato indietro",$inline2,"inline");
}

switch($testo)
{

case 'Fungi':
     $out = sendMsg($botToken,$chatId,"Fungo");
   //  $inlineKB = '[{"text" : "Vai su Google", "url" : "https://www.google.com"},{"text" : "Vai al Blog", "url" : "https://ettoremorettiblog.it"}]';
   // $out = sendMsg($botToken,$chatId,"Invio un messaggio con una inlineKeyboard!",$inlineKB,"inline");
break;

  case '/inline':
    $inlineKB = '[{"text" : "Vai su Google", "url" : "https://www.google.com"},{"text" : "Dove Pullare", "callback_data" : "povero"}]';
    $out = sendMsg($botToken,$chatId,"Invio un messaggio con una inlineKeyboard!",$inlineKB,"inline");
  break;
        
}
?>
