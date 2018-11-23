<?php
require_once "PDOMain.php";



class User extends PDOMain{
private $table;



function __construct($table){
    parent::__construct();
    $this->table = $table;
}



function _getLogin ($login){
    $user = $this->_selPDO($this->table, "*", "WHERE login='$login'");
    if (count($user) > 0) return $user;
    else return 0;
}



function addUserToTable($login, $password, $mail, $phone, $name, $surname, $veryLastName){
    $this->_insPDO($this->table, "`Login`, `Password`, `Mail`, `Phone`, `Name`, `Surname`, `VeryLastName`", "'$login', '$password', '$mail', '$phone', '$name', 
    '$surname', '$veryLastName'");
}



}

?>