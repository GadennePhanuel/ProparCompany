<?php
session_start();

unset($_SESSION['login']);

if (!isset($_SESSION['login']) and empty($_SESSION['login'])){
    $errorMsg['loginExist'] = false;
    echo json_encode($errorMsg);
    exit();
}else{
    $errorMsg['loginExist'] = true;
    echo json_encode($errorMsg);
    exit();
}