<?php
require_once "../vendor/autoload.php";
use ProparCompany\Singleton;

 $dbi = Singleton::getInstance()->getConnection();
 $req = $dbi->prepare("SELECT * FROM jobs_type ORDER BY price DESC
 ");
 $req->execute();
 $req = $req->fetchAll(PDO::FETCH_ASSOC);  //array 2 dimension, sous dimension = un jobType

echo json_encode($req);