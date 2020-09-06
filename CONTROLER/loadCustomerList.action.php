<?php
session_start();
include_once '../vendor/autoload.php';
use ProparCompany\Singleton;

$dbi = Singleton::getInstance()->getConnection();


//on récupére de la DT la liste des customer existant trié par ordre alphabétique
$req = $dbi->prepare("SELECT id_customer, UPPER(name) as name, concat(UPPER(LEFT(customers.firstname,1)),LOWER(SUBSTRING(customers.firstname, 2, length(customers.firstname)))) as firstname, UPPER(city) as city, email
                                FROM customers
                                ORDER BY name
");
$req->execute([]);

$req = $req->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($req);