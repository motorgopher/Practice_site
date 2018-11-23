<?php

$link = mysqli_connect ('localhost','root','','practice_base');
$select_db = mysqli_select_db ($link, 'practice_base');

if (mysqli_connect_errno()){
    echo 'Ошибка подключеняи к БД ('.mysqli_connect_errno().'): '.mysqli_connect_error();
    exit();
}
