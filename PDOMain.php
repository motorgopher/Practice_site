<?php

class PDOMain{



private $MPDO;

function __construct() {

    $this->_conadb();
    session_start();
}

function _conadb($dbhost ='localhost', $dbuser = 'root', $dbpassword = '', $dbname = 'practice_base'){

    try{
        $this->MPDO = new PDO("mysql:dbname=$dbname; host=$dbhost;charset=utf8", "{$dbuser}", "{$dbpassword}");
        return $this->MPDO;
    }catch (PDOException $e) {
        echo "Ошибка при подклчении к базе данных: ".$e->getMessage();
    }
}

function _selPDO ($db, $cols, $where="", $order="", $limit=""){
    $sql = "SELECT {$cols} FROM {$db} {$where} {$order} {$limit}";
    $rs = $this->MPDO->query($sql);
    $rs->execute();
    if ($where != ""){
        $row = $rs->fetchALL(PDO::FETCH_ASSOC);
        return $row;
    }else{
        $row = $rs->fetchALL(PDO::FETCH_ASSOC);
        return $row;
    }
}

function _insPDO ($db, $cols="", $values=""){
    if ($cols == " ") echo "Ошибка при занесении данных";
    $sql = "INSERT INTO $db ($cols) VALUES ($values)";
    $this->MPDO->query($sql);
}

function _updPDO ($db, $what, $val, $where){
    $sql = "UPDATE {$db} SET {$what}='{$val}' {$where}";
    $this->MPDO->query($sql);
}

function _delPDO ($db, $where){
    $sql = "DELETE FROM {$db} {$where}";
    $this->MPDO->query($sql);
}

}
?>