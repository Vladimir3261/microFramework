<?php

namespace Library;
use Model\translateModel;

/**
 * Description of Translate
 *
 * @author vladimir
 */
class App {
    public static function t($message = null){
        $model = new translateModel;
        
        if(!isset($_COOKIE['language'])){
            return $message;
        }else{
            $lang = filter_var($_COOKIE['language'], FILTER_VALIDATE_REGEXP,
            array("options"=>array("regexp"=>"([a-z]{2})")));
            $newMessage = $model->getTranslate($message, $lang);
            
            if($newMessage){
                return $newMessage;
            }
            return $message;
        }
    }
}
