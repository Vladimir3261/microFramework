<?php
namespace Model\test;
use Library\ModelBase;

class testModel extends ModelBase {
    function test() {
        var_dump($this->Adapter);
    }
}
