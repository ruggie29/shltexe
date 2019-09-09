<?php

function sendMsg($tkn, $cId, $msgTxt, $tastiera = null, $tipo = null){
    
    $reply_markup = "";

    if($tastiera != null ){
        if($tipo == "inline"){
            $reply_markup = '&reply_markup={"inline_keyboard":['.$tastiera.'],"resize_keyboard":true}';
        }elseif($tipo == "reply"){
            $reply_markup = '&reply_markup={"keyboard":['.$tastiera.'],"resize_keyboard":true}';
        }
    }
    
    $TelegramUrlSendMessage = "https://api.telegram.org/".$tkn."/sendMessage?chat_id=".$cId."&parse_mode=HTML&text=".urlencode($msgTxt).$reply_markup;


    return file_get_contents($TelegramUrlSendMessage);
}

 function saveInJsonFile($data, $filename){
    if(file_exists($filename))
        unlink($filename);
    file_put_contents($filename,json_encode($data,JSON_PRETTY_PRINT));
}

function editMsg($tkn,$cId,$msgId,$newText,$tastiera = null, $tipo = null){
    
        $reply_markup = "";

    if($tastiera != null ){
        if($tipo == "inline"){
            $reply_markup = '&reply_markup={"inline_keyboard":['.$tastiera.'],"resize_keyboard":true}';
        }elseif($tipo == "reply"){
            $reply_markup = '&reply_markup={"keyboard":['.$tastiera.'],"resize_keyboard":true}';
        }
    }
    
    $TelegramUrlSendMessage = "https://api.telegram.org/".$tkn."/editMessageText?chat_id=".$cId."&message_id=".$msgId."&parse_mode=HTML&text=".urlencode($newText).$reply_markup;
                      

    return file_get_contents($TelegramUrlSendMessage);
}

function bandit($testo,$bandit)
{
if(stristr($testo, $bandit) !== FALSE) {
    return 1;
  }
}

function countmembers ($tkn,$cId)
{
    
    $TelegramUrlSendMessage = "https://api.telegram.org/".$tkn."/getChatMembersCount?chat_id=".$cId;                      

    $int=file_get_contents($TelegramUrlSendMessage);
   
   // $result = $int['ok'];
    
    return $int;
}

function getmembers ($tkn,$cId,$userId)
{
    
    $TelegramUrlSendMessage = "https://api.telegram.org/".$tkn."/getChatMember?chat_id=".$cId."&user_id=".$userId;                      

    return file_get_contents($TelegramUrlSendMessage);
   
   
    $int=file_get_contents($TelegramUrlSendMessage);
   
   // $result = $int['ok'];
    
    return $int;
    
}

function getAllert ($tkn,$queryId,$msgTxt)
{
    
    $TelegramUrlSendMessage = "https://api.telegram.org/".$tkn."/answerCallbackQuery?callback_query_id=".$queryId."&text=".$msgTxt."&show_alert=TRUE";  
    
    return file_get_contents($TelegramUrlSendMessage);
}

function replayMsg ($tkn,$cId,$msgId, $msgTxt)
{
    $TelegramUrlSendMessage = "https://api.telegram.org/".$tkn."//sendMessage?chat_id=".$cId."&parse_mode=HTML&text=".urlencode($msgTxt)."&reply_to_message_id=".$msgId.;
    
    return file_get_contents($TelegramUrlSendMessage);
}
?>
