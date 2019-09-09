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
$MessageGroup = $update['chat'];
$msxid = $MessageGroup['id'];


$query = $update['callback_query'];
$queryid = $query['id'];
$queryuser = $query['from']['id'];
$querydata = $query['data'];
$queryname = $query['from']['first_name'];
$querymsg = $query['message']['message_id'];
$querytag = $query['from']['username'];
$querychat = $query['chat']['id'];
$queryallert = $query['callback_query_id'];

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
 $out= getAllert ($botToken,$queryuser,"Povero");
  
}

if($querydata == "back")
{
  
    $inline2 = '[{"text" : "Vai su Google", "url" : "https://www.google.com"},{"text" : "Dove Pullare", "callback_data" : "povero"}]';
     $out = editMsg($botToken,$queryuser,$querymsg,"Cosa vuoi fare?",$inline2,"inline");
}

if($querydata == "Sì")
{
  
    $inline2 = '[{"text" : "Risolto ", "callback_data" : "risolto"}]';
     $out = sendMsg($botToken,$queryid,"Un utente ha richiesto assistenza:
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
     $out = editMsg($botToken,$queryuser,$querymsg,"Un utente ha richiesto assistenza:
\xF0\x9F\x97\xBF : $queryname
\xF0\x9F\x91\xA4 : @$querytag
\xF0\x9F\x93\x94 : $queryuser

Stato: 	\xE2\x9C\x85",$inline2,"inline");
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
    $out = sendMsg($botToken,$chatId,"E' $queryallert");
  break;
    
  case '/assistenza':
     $inlineKB = '[{"text" : "Sì", "callback_data" : "Sì"},{"text" : "No", "callback_data" : "No"}]';
    $out = sendMsg($botToken,$chatId,"Sei sicuro di voler richiedere assistenza?",$inlineKB,"inline");
    break;
    
  case 'id':
    $out = sendMsg($botToken,$chatId,"Eccolo:$chatId");
    break;
  
  case '/conta':
    $count = countmembers($botToken,$chatId);
    $finale = json_decode($count, TRUE);
    $result =$finale['result'];
    $out = sendMsg($botToken,$chatId,"Sono: $result");
  break;
  

    
           
}
?>
