<?php
session_start();
include_once '../vendor/autoload.php';
use ProparCompany\Singleton;


$dbi = Singleton::getInstance()->getConnection();

$req = $dbi->prepare("SELECT DISTINCT status
                                FROM workers
");
$req->execute();

$req = $req->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($req);
