<?php

pubblic function sendMsg($tkn, $cId, $msgTxt, $tastiera = null, $tipo = null){
    
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

oubblic function saveInJsonFile($data, $filename){
    if(file_exists($filename))
        unlink($filename);
    file_put_contents($filename,json_encode($data,JSON_PRETTY_PRINT));
}

pubblic function editMsg($tkn,$cId,$msgId,$newText,$tastiera = null, $tipo = null){
    
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
?>
