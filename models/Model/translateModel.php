<?php

namespace Model;
use Library\ModelBase;

/**
 * Description of translateModel
 *
 * @author vladimir
 */
class translateModel extends ModelBase {
    public function getTranslate($mess, $lang){
        $sql = "SELECT id, $lang FROM translates WHERE message  = :message LIMIT 0,1";
        $sth = $this->Adapter->prepare($sql, array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
        $sth->execute(array(':message'=> $mess));
        $res = $sth->fetch();
        return $res[$lang];
    }
}
