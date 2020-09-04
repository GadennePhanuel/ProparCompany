<?php
session_start();

if (isset($_SESSION['login']) && !empty($_SESSION['login'])){
    $errorMsg['loginExist'] = true;
    echo json_encode($errorMsg);
    exit();
}else{
    $errorMsg['loginExist'] = false;
    echo json_encode($errorMsg);
    exit();
}