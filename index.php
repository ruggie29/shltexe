<?php


$botToken = "bot"."969847936:AAEHT-nNJsOTRSyqhJeazDm3TCh1ZaBd1XU";

//è necessario aggiungere bot prima del nostro token
//You must add bot before our token

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
$MikeId = "424842427";
$testo = $MessageObj['text'];
$nome =  $MessageObj['from']['first_name'];
$tag =  $MessageObj['from']['username'];

//Salvo il json ricevuto per analizzarlo in seguito
//We save the json received to parse it later
//saveInJsonFile($update, "ricevuto.json");

//Creaiamo una replykeyboard
//We create a replykeabord

switch($testo)
{
  case '/staff':
    $out = sendMsg($botToken,$MikeId,"Il comando staff è stato richiamato. 
Di seguito le informazioni:

<b>Nome utente</b>: $nome;

<b>Tag Telegram</b>: @$tag;");
    break;
    
  case '.staff':
    $out = sendMsg($botToken,$MikeId,"Il comando staff è stato richiamato. 
Di seguito le informazioni:

<b>Nome utente</b>: $nome;

<b>Tag Telegram</b>: @$tag;");
    break;
}

//Rispondiamo HelloWorld
//We answer HelloWorld
//$out = sendMsg($botToken,$chatId,"Invio un messaggio!");

//Salvo il json ricevuto per analizzarlo in seguito
//We save the json received to parse it later
//saveInJsonFile($out, "inviato.json");


/**
 * 
 * FUNCTION AREA
 * 
 */

//Funzione per far inviare un messaggio da parte del bot
//Function to send a message from the bot
function sendMsg($tkn, $cId, $msgTxt, $tastiera = null, $tipo = null){

    //Controlliamo se è stata passata una tastiera e popoliamo il parametro reply_markup della sendMessage
    $reply_markup = "";

    if($tastiera != null ){
        if($tipo == "inline"){
            $reply_markup = '&reply_markup={"inline_keyboard":['.$tastiera.'],"resize_keyboard":true}';
        }elseif($tipo == "reply"){
            $reply_markup = '&reply_markup={"keyboard":['.$tastiera.'],"resize_keyboard":true}';
        }
    }

    /*
        Creiamo la URL per richiamare la API Telegram apposita, nel nostro caso sarà la sendMessage.
        Questa API richiede due parametri obbligatori, chatId e Testo del messaggio
        NB: La chiamata alla API sarà in GET, quindi è consigliato (fortemente consigliato) di inviare il testo all'interno di un urlencode().


        Create the URL to invoke the appropriate API in this case will be the Telegram sendMessage. 
        This API requires two required parameters, chatId and message text 
        NOTE: the call to the API will GET, so it is recommended (strongly recommended) to send the text within a urlencode ().
    */
    $TelegramUrlSendMessage = "https://api.telegram.org/".$tkn."/sendMessage?chat_id=".$cId."&parse_mode=HTML&text=".urlencode($msgTxt).$reply_markup;

    //Come return della funzione restituiremo l'output di file_get_contents della URL appena creata.
    //As a return of the function we will return the output of file_get_contents of the URL just created.
    return file_get_contents($TelegramUrlSendMessage);
}

//Questa è la funzione che utilizzo per salvare il json nei file
//This is the function i use to save the json in file
function saveInJsonFile($data, $filename){
    if(file_exists($filename))
        unlink($filename);
    file_put_contents($filename,json_encode($data,JSON_PRETTY_PRINT));
}
?>
