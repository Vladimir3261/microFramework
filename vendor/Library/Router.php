<?php
/*
 * Класс Router получает данные из адресной строки и выполняет поиск
 * и подключение контроллеров соответствующим запросу из url
 */
namespace Library;

Class Router {

    private $route;
    private $params;
/*
 * Конструктор принимает параметры из GET заголовка 
 * если таковых нет роутер отправляет на индексную страницу
 */
    function __construct(){
        if (empty($_GET['route'])){
            $this->route ='index';
        }
        else{
            $this->route =  $_GET['route'];
        }
    }
/*
 * Метод run() выполняет поиск и подключение контроллера и соответствующего действия
 */
    function run() {
// Переводим в массив пришедшие данные
        $parts = explode('/', $this->route);
// Путь к папке контроллеров и скриптов вида        
     $full = '../controllers/Controller';
     $fullTemplate = '../views';
// Проход циклом по массиву
        foreach($parts as $part) {
// Определяем есть ли указанные директории в папке controllers
            if(is_dir($full.DIRSEP.$part)) {
            $full .= DIRSEP.$part;
            $fullTemplate .= DIRSEP.$part;
            array_shift($parts);
            }
// Поиск файла контроллера           
            elseif(is_file($full.DIRSEP.$part.'Controller.php')) {
              $controller = $full .= DIRSEP.$part.'Controller.php';
              $template = $fullTemplate.= DIRSEP.$part;
              $controllerName = $part.'Controller';
              array_shift($parts);
              break;
            }
        }
// Если файл с нужным контроллером не найден, назначается контроллером indexController      
        if(!isset($controller)) {
            if(is_file($full.DIRSEP.'indexController.php')) {
                $controller = $full.DIRSEP.'indexController.php';
                $template = $fullTemplate.DIRSEP.'index';
                $controllerName = 'indexController';
            }
            else {
                die ('404 Not Found');
            }
             
        }
// Определяем дейстивие (Action)
        $actionPart = array_shift($parts);
       if(!intval($actionPart)){
        $action = $actionPart.'Action';
        $templateAction = $actionPart.'.phtml';           
       }else{
           $action = 'Action';
           $parts = $actionPart;
       }

// Если Action не был передан, назначается indexAction
            if($action == 'Action') {
                $action = 'indexAction';
                $templateAction = 'index.phtml';
            }
// Определяем путь к файлу вида (view)            
            $template .= DIRSEP.$templateAction;
// Осальные параметры записываются в масив параметров
            $this->params = $parts;
// Прдключение   контроллера и создание его экземпляра         
            include($controller);
  
            $class =  '\Controller\\'.$controllerName;
// В конструктор контроллера передаем параметры для дальнейшей работы с ними            
            $controllerObject = new $class($this->params);
 // Проверка на наличие указаного Action в методах класса если такого нет - 404           
        if (is_callable(array($controllerObject, $action)) == false) {
            die ('404 Not Found');
        }
// Добавление в реестр пути к скрипту вида
         Registry::setTemplate($template);
// Вызов запрошеного метода  (Action)
        $controllerObject->$action();
    }
}