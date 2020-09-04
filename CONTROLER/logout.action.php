<?php
session_start();

unset($_SESSION['login']);
unset($_SESSION['name']);
unset($_SESSION['firstname']);
unset($_SESSION['status']);

if (!isset($_SESSION['login']) and empty($_SESSION['login'])){
    $errorMsg['loginExist'] = false;
    echo json_encode($errorMsg);
    exit();
}else{
    $errorMsg['loginExist'] = true;
    echo json_encode($errorMsg);
    exit();
}