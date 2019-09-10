<?php
include "function.php";
include "bandit.php";
include "bot.php";

$TelegramRawInput = file_get_contents("php://input");
$TelegramMexBot = file_get_contents("inviato.json");

$update = json_decode($TelegramRawInput, TRUE);
$botout =  json_decode($TelegramMexBot, TRUE);

if(!$update)
{
  //exit;
}

//public $testo;

$MessageObj = $update['message'];
$chatId = $MessageObj['chat']['id'];
$msxId = $MessageObj['message_id'];
//$MikeId = "424842427";
$testo = $MessageObj['text'];
$nome =  $MessageObj['from']['first_name'];
$tag =  $MessageObj['from']['username'];
$MessageGroup = $update['chat'];



$query = $update['callback_query'];
$queryid = $query['id'];
$queryuser = $query['from']['id'];
$querydata = $query['data'];
$queryname = $query['from']['first_name'];
$querymsg = $query['message']['message_id'];
$querytag = $query['from']['username'];
$querychat = $query['chat']['id'];
$queryallert = $query['callback_query_id'];

$sticker= $MessageObj['sticker'];
$animated = $sticker['is_animated'];

saveInJsonFile($update, "ricevuto.json");


if($sticker != '')
{
  if($animated == '1')
  {
  $out = replayMsg($botToken,$chatId,$msxId,"/warn");
  }
     if($animated == '0')
     {
     $out = replayMsg($botToken,$chatId,$msxId,"/del");
     }
}

 $info = getmembers($botToken,'-1001469403482','773826549');
 $finale = json_decode($info, TRUE);
 $result =$finale['result']['status'];
/*
if($result == "kicked")
{
  $out = sendMsg($botToken,$chatId,"L'utente ha abbandonato la chat");
}
*/
$controllo = bandit($testo,$bandit1);
if ($controllo == 1)
{
  $out = sendMsg($botToken,$chatId,"Parola bandita trovata");
}

if($querydata == "povero")
{
  //$out = editMsg($botToken,$queryuser,$querymsg,"Povero");
 // $inline2 = '[{"text" : "<<Indietro", "callback_data" : "back"},{"text" : "Dove Pullare", "callback_data" : "povero", "show_allert" : true}]';
 // $out = editMsg($botToken,$queryuser,$querymsg,"Stai fermo che sei povero",$inline2,"inline");
 $out= getAllert ($botToken,$queryid,"Povero");
  
}

if($querydata == "back")
{
  
    $inline2 = '[{"text" : "Vai su Google", "url" : "https://www.google.com"},{"text" : "Dove Pullare", "callback_data" : "povero"}]';
     $out = editMsg($botToken,$queryuser,$querymsg,"Cosa vuoi fare?",$inline2,"inline");
}

if($querydata == "Sì")
{
  
    $inline2 = '[{"text" : "Risolto ", "callback_data" : "risolto"}]';
     $out = sendMsg($botToken,"-326569289","Un utente ha richiesto assistenza:
\xF0\x9F\x97\xBF : $queryname
\xF0\x9F\x91\xA4 : @$querytag
\xF0\x9F\x93\x94 : $queryuser

Stato: 	\xE2\x9D\x8C",$inline2,"inline");
  
  $out = sendMsg($botToken,"159645625","Un utente ha richiesto assistenza:
\xF0\x9F\x97\xBF : $queryname
\xF0\x9F\x91\xA4 : @$querytag
\xF0\x9F\x93\x94 : $queryuser

Stato: 	\xE2\x9D\x8C",$inline2,"inline");
  
}

if($querydata == "Aperto")
{
  
    $inline2 = '[{"text" : "Risolto ", "callback_data" : "risolto"}]';
     $out = editMsg($botToken,$queryuser,$querymsg,"Un utente ha richiesto assistenza:
\xF0\x9F\x97\xBF : $queryname
\xF0\x9F\x91\xA4 : @$querytag
\xF0\x9F\x93\x94 : $queryuser

Stato: 	\xE2\x9D\x8C",$inline2,"inline");
}

if($querydata == "risolto")
{
  
    $inline2 = '[{"text" : "Riapri ", "callback_data" : "Aperto"}]';
     $out = editMsg($botToken,"-326569289",$querymsg,"Un utente ha richiesto assistenza:
\xF0\x9F\x97\xBF : $queryname
\xF0\x9F\x91\xA4 : @$querytag
\xF0\x9F\x93\x94 : $queryuser

Stato: 	\xE2\x9C\x85 da: @$querytag ",$inline2,"inline");
}

switch($testo)
{

case 'Fungi':
     $out = sendMsg($botToken,$chatId,"Fungo");
   //  $inlineKB = '[{"text" : "Vai su Google", "url" : "https://www.google.com"},{"text" : "Vai al Blog", "url" : "https://ettoremorettiblog.it"}]';
   // $out = sendMsg($botToken,$chatId,"Invio un messaggio con una inlineKeyboard!",$inlineKB,"inline");
break;

  case 'Pull':
    $inlineKB = '[{"text" : "Vai su Google", "url" : "https://www.google.com"},{"text" : "Dove Pullare", "callback_data" : "povero"}]';
    $out = sendMsg($botToken,$chatId,"Cosa vuoi fare?",$inlineKB,"inline");
  break;
    
  case 'Assistenza':
     $inlineKB = '[{"text" : "Sì", "callback_data" : "Sì"},{"text" : "No", "callback_data" : "No"}]';
    $out = sendMsg($botToken,$chatId,"Sei sicuro di voler richiedere assistenza?",$inlineKB,"inline");
    break;
    
  case 'Id':
    $out = sendMsg($botToken,$chatId,"Eccolo:$chatId");
    break;
  
  case '/conta':
    $count = countmembers($botToken,$chatId);
    $finale = json_decode($count, TRUE);
    $result =$finale['result'];
    $out = sendMsg($botToken,$chatId,"Sono: $result");
  break;
  
   case 'Dio':
    $out = replayMsg($botToken,$chatId,$msxId,"Porco");
    break;
    
  case '/start':
   $replyKB = '["Dio","Id"],["Assistenza"],["Pull"]';
    $out = sendMsg($botToken,$chatId,"Benvenuto nel bot di supporto!
La tua tastiera è stata modificata per permetterti di inserire i comandi che questo bot può fare.
Se utilizzi una versione di telegram che non supporta questa modifica scrivi /menu per richiamare la lista dei comandi.
",$replyKB,"reply");
      
    
     break;
     
           
}

if($out <> "")
{
saveInJsonFile($botout, "inviato.json");
}

?>
