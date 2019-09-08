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

//public $testo;

$MessageObj = $update['message'];
$chatId = $MessageObj['chat']['id'];
//$MikeId = "424842427";
$testo = $MessageObj['text'];
$nome =  $MessageObj['from']['first_name'];
$tag =  $MessageObj['from']['username'];


$query = $update['callback_query'];
$queryid = $query['id'];
$queryuser = $query['from']['id'];
$querydata = $query['data'];
$querymsg = $query['message']['message_id'];

$controllo = bandit($testo,$bandit1);
if ($controllo == 1)
{
  $out = sendMsg($botToken,$chatId,"Parola bandita trovata");
}

if($querydata == "povero")
{
  //$out = editMsg($botToken,$queryuser,$querymsg,"Povero");
  $inline2 = '[{"text" : "<<Indietro", "callback_data" : "back"},{"text" : "Dove Pullare", "callback_data" : "povero"}]';
  $out = editMsg($botToken,$queryuser,$querymsg,"Stai fermo che sei povero",$inline2,"inline");
}

if($querydata == "back")
{
  
    $inline2 = '[{"text" : "Vai su Google", "url" : "https://www.google.com"},{"text" : "Dove Pullare", "callback_data" : "povero"}]';
     $out = editMsg($botToken,$queryuser,$querymsg,"Cosa vuoi fare?",$inline2,"inline");
}

if($querydata == "Sì")
{
  
    $inline2 = '[{"text" : "Risolto \xE2\x9D\x8E", "callback_data" : "risolto"}]';
     $out = editMsg($botToken,$queryuser,$querymsg,"Segnalazione effettuata da @$tag",$inline2,"inline");
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
    $out = sendMsg($botToken,$chatId,"Cosa vuoi fare?",$inlineKB,"inline");
  break;
    
  case '/assistenza':
     $inlineKB = '[{"text" : "Sì", "callback_data" : "Sì"},{"text" : "No", "callback_data" : "No"}]';
    $out = sendMsg($botToken,$chatId,"Sei sicuro di voler richiedere assistenza?",$inlineKB,"inline");
    break;
    
        
}
?>
