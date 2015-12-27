<?php

namespace Controller;
use Library\Controller_base;
use Library\ViewBase;
#use Library\Validate;
use Model\registerModel;

/**
 * Description of registerprocessController
 *
 * @author vladimir
 */
class registerprocessController extends Controller_Base {
    function indexAction(){
        var_dump($_POST);die();
        // Проверка Валидности данных
        $data = $this->validate();
        /* Если не проходит валюдацию возвращается массив data  
         * с данными и массив error с полями которые не прошли валюдацию
         */
        if(count($data['validate_error'])){
            \Library\Registry::setTemplate('../views/register/index.phtml');
            return new ViewBase(array('data' => $data['data'], 'validate_error' => $data['validate_error']));
        }
        // Проверяем на наличие регистрации пользователя с таким username или email
        // Если такой есть, возвращаются все данные
        //  и массив error с указанием данных которые уже зарегистрированны
        $model = new registerModel;
        $checkRegister = $model->checkRegister($data['data']);
        if($checkRegister){
            \Library\Registry::setTemplate('../views/register/index.phtml');
            return new ViewBase(array('data' => $data['data'], 'check_error' => $checkRegister));            
        }
        
        /*
         * РЕГИСТРАЦИЯ
         */
        else{
        // File upload
            $newmame = 'not_avatar.jpg';
            if($_FILES['upload']['size'] > 0){
                if(is_uploaded_file($_FILES["upload"]["tmp_name"])){
                  $newname = rand(0,1000).time().'.png';
                  move_uploaded_file($_FILES["upload"]["tmp_name"], "images/".$newname);
                }
            }
        // FIle Upload
            $user = array('data' => $data['data'], 'img' => $newname);
            if($model->save($user)){
                $this->redirect('/');
            }
        }
        /*
         * РЕГИСТРАЦИЯ
         */
    }
    
    public function checkAction(){
        $email = $_POST['email'];
        if (filter_var($email, FILTER_VALIDATE_EMAIL)){
        $model = new registerModel();
            if($model->checkEmail($_POST['email'])){
                echo json_encode(array('val' => 'Error'));   
            }else{
                echo json_encode(array('val' => "OK"));
            }
        }
    }
    public function nicknamevalidateAction(){
        
    }
    
    private function validate(){
        $filter = array(
    'email' => FILTER_VALIDATE_EMAIL,
    'nick' => array(
        'filter' => FILTER_VALIDATE_REGEXP,
        'options' => array(
            'regexp' => '/^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$/i',
        ),
    ),
    'name' => array(
        'filter' => FILTER_VALIDATE_REGEXP,
        'options' => array(
            'regexp' => '/^([a-zа-яё]+|\d+)$/i',
        ),
    ),
    'city' => array(
        'filter' => FILTER_VALIDATE_REGEXP,
        'options' => array(
            'regexp' => '/^([a-zа-яё]+|\d+)$/i',
        ),
    ),
    'date' => array(
        'filter' => FILTER_VALIDATE_REGEXP,
        'options' => array(
            'regexp' => '/(19|20)\d\d-((0[1-9]|1[012])-(0[1-9]|[12]\d)|(0[13-9]|1[012])-30|(0[13578]|1[02])-31)/',
        ),
    ),
    'password' => array(
        'filter' => FILTER_VALIDATE_REGEXP,
        'options' => array(
            'regexp' => '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/',
        ),
    ),
    'confirm' => array(
        'filter' => FILTER_VALIDATE_REGEXP,
        'options' => array(
            'regexp' => '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/',
        ),
    ),
);
        $error = array();
        /*
         * Проверка файла
         */
        $allowedTypes = array('image/png', 'image/jpg', 'image/jpeg', 'image/bmp');
        if($_FILES['upload']['size'] > 0){
            if($_FILES["upload"]["size"] > 1024*3*1024){
                array_push($error, 'image');
            }
            elseif(!in_array($_FILES["upload"]["type"], $allowedTypes)){
                array_push($error, 'image');
            }
        }
        /*
         * Проверка файла
         */
        
       $data = filter_input_array(INPUT_POST, $filter);
       
       foreach($data as $key => $value){
           if($value == false){
               array_push($error, $key);
           }
       }
       return array('validate_error' => $error, 'data' => $_POST);
    }
}
