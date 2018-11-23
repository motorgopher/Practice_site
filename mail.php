<?php

    $name_mail = $_POST['name_mail'];
    $last_name_mail = $_POST['last_name_mail'];
    $very_last_name_mail = $_POST ['very_last_name_mail'];
    $email_mail = $_POST ['email_mail'];
    $phone_mail = $_POST ['phone_mail'];
    $message_mail = $_POST['message_mail'];
    $message_content = "Заявка от $name_mail $last_name_mail $very_last_name_mail, Mail адрес: $phone_mail, Номер телефона: $phone_mail Проблема: $message_mail";

    mail("m.druzhinin73@gmail.com", "Заявка с сайта", $message_content);