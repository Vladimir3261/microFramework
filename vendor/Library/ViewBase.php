<?php
/*
 * Класс ViewBase базвый класс вызывается в каждом контроллере, подключает нужный
 * view файл и передает в скрипт вида параметры принятые конструктором класса 
 */
namespace Library;
use Model\translateModel;

 class ViewBase {
    public $params;
    public $sitePath;
    public $translate;
    
    /*
     * Конструктор Принимает данные переданные при создании экземпляра класса 
     * и подключает файлы вида
     */
    function __construct($viewParams = NULL) {
//Путь к файлам css js ... для подключения в браузере
        $this->sitePath = 'http://'.$_SERVER['HTTP_HOST'].'/';
// Возврат полученных параметров в view скрипт
        $this->params = $viewParams;
// Подключается необходимый view файл
        include(Registry::getTemplate());
    }

// Метод для перевода    
     function t($message = null){
        $model = new translateModel;
// Проверяем на наличие установленой куки с языком        
        if(!isset($_COOKIE['language'])){
            return $message; // Если нет возвращаем текст оригинала
        }else{
// Проверка на валидность информации в куках
            $lang = filter_var($_COOKIE['language'], FILTER_VALIDATE_REGEXP,
            array("options"=>array("regexp"=>"([a-z]{2})")));
// Поиск в БД запрошенного текста
            $newMessage = $model->getTranslate($message, $lang);
// Если есть возвращаем перевод            
            if($newMessage){
                return $newMessage;
            }
            return $message;
        }
    }
}