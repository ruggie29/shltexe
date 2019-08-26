<?php

include "function.php";
include "db.php";

//è necessario aggiungere bot prima del nostro token
//You must add bot before our token
$botToken = "bot"."969847936:AAEHT-nNJsOTRSyqhJeazDm3TCh1ZaBd1XU";


//Recuperiamo l'input che riceveremo dal bot
//We retrieve the input we receive from bot
$TelegramRawInput = file_get_contents("php://input");
// php://input restituisce i dati raw (testo), andremo quindi a formattare il tutto in un array, i dati che riceveremo saranno in formato Json quindi un json_decode farà al caso nostro.
// php // input returns the raw data (text), then we will format everything in an array, the data we receive will be in Json format so a json_decode will be for us.
$update = json_decode($TelegramRawInput, TRUE);

//Assicuriamoci di aver ricevuto un update, altrimenti interrompiamo l'esecuzione
//Make sure you have received an update, otherwise we interrupt execute
if(!$update)
{
  //exit;
}

//Recuperiamo l'oggetto message dal json
//We recover the message object from json
$MessageObj = $update['message'];
//Recuperiamo il chatId, che utilizzeremo per rispondere all'utente che ci ha appena invocato
//We recover the chatId table which we will use to respond to the user who has just invoked
$chatId = $MessageObj['chat']['id'];
$Testo = $MessageObj['text'];
$MikeId = '424842427';
$Name = $MessageObj['from']['first_name'];
$Tag = $MessageObj['from']['username'];
$date = date('Y-m-d H:i:s');

//Salvo il json ricevuto per analizzarlo in seguito
//We save the json received to parse it later
saveInJsonFile($update, "ricevuto.json");

//Creaiamo una replykeyboard
//We create a replykeabord

//$replyKB = '["Btn 1","Btn 2"],["Test"],["Inviami"]';

//$out = sendMsg($botToken,$chatId,"Invio un messaggio con una replyKeyboard!",$replyKB,"reply");

//Creaiamo una inlineKeyboard
//We create an inlineKeyboard

//$inlineKB = '[{"text" : "Mike è bell", "text": "NO!" },{"text" : "Rug è bell",  "text": "BRAVO!"}]';
//$inlineKB = '[{"text" : "Mike è bell"}]';
//$out = sendMsg($botToken,$chatId,"Mike o Rug?",$inlineKB,"inline");
switch ($Testo)
{
  case '/staff':
    $out = sendMsg($botToken,$chatId,"Il comando staff è stato richiamato. 

Di seguito le informazioni:

<b>Nome utente</b>: $Name;

<b>Tag Telegram</b>: @$Tag;");
break;
    
  case '.staff':
    $out = sendMsg($botToken,$chatId,"Il comando staff è stato richiamato. 

Di seguito le informazioni:

<b>Nome utente</b>: $Name;

<b>Tag Telegram</b>: @$Tag;");
break;
    
  case '/conta':
    $Serch = MemberCount($tkn, $cId, "cacca");
    
     $out = sendMsg($botToken,$chatId,"$Search");
   break;
   
}


//Rispondiamo HelloWorld
//We answer HelloWorld
//$out = sendMsg($botToken,$chatId,"Invio un messaggio!");

//Salvo il json ricevuto per analizzarlo in seguito
//We save the json received to parse it later
saveInJsonFile($out, "inviato.json");


?>

