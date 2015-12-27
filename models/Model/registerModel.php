<?php

namespace Model;
use Library\ModelBase;

/**
 * Description of register
 *
 * @author vladimir
 */

class registerModel extends ModelBase {
    function checkRegister($data){
        $error = array();
        if($this->checkEmail($data['email'])){
            array_push($error, 'email');
        }
        if($this->checkNickname($data['nick'])){
            array_push($error, 'nick');
        }
        return $error;
    }
    public function checkNickname($nickname){
        $sql = 'SELECT id, nickname FROM user WHERE nickname = :nickname';
        $sth = $this->Adapter->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
        $sth->execute(array(':nickname'=> $nickname));
        $res = $sth->fetchAll();
        return $res;
    }
    public function checkEmail($email){
        $sql = 'SELECT id, email FROM user WHERE email = :email';
        $sth = $this->Adapter->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
        $sth->execute(array(':email'=> $email));
        $res = $sth->fetchAll();
        return $res;
    }
    
    public function save($params){
        $data = $params['data'];
        $img = $params['img'];
        $sql = $this->Adapter->prepare("INSERT user (nickname, email, name, date, city, password, avatar)"
                . " VALUES (:nickname, :email, :name, :date, :city, :password, :avatar)");
        return $sql->execute(array(
        ':nickname'  => $data['nick'], 
        ':email' => $data['email'],
        ':name' => $data['name'],
        ':date' => strtotime($data['date']),
        ':city' => $data['city'],
        ':avatar' => $img,
        ':password' => crypt($data['password'])));
    }
}
