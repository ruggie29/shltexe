<?php
/**
 * 
 * FUNCTION AREA
 * 
 */
//Funzione per far inviare un messaggio da parte del bot
//Function to send a message from the bot
function sendMsg($tkn, $cId, $msgTxt,$tastiera = null, $tipo = null){
    //Controlliamo se è stata passata una tastiera e popoliamo il parametro reply_markup della sendMessage
    $reply_markup = "";
    if($tastiera != null ){
        if($tipo == "inline"){
            $reply_markup = '&reply_markup={"inline_keyboard":['.$tastiera.'],"resize_keyboard":true}';
        }elseif($tipo == "reply"){
            $reply_markup = '&reply_markup={"keyboard":['.$tastiera.'],"resize_keyboard":true}';
        }
    }
    $mode = "";
  
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
    function MemberCount($tkn, $cId, $msgTxt){

    $TelegramUrlSendMessage = "https://api.telegram.org/".$tkn."/getChatMembersCount?chat_id=".$cId."&parse_mode=HTML&text=".urlencode($msgTxt).$reply_markup;
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
