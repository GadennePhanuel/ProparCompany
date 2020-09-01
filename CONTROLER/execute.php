<?php
require_once '../MODELE/Singleton.class.php';
require_once '../MODELE/DBManagement.class.php';
require_once '../MODELE/JobType.class.php';
require_once '../MODELE/Job.class.php';
require_once '../MODELE/Person.class.php';
require_once '../MODELE/Worker.class.php';
require_once '../MODELE/Customer.class.php';





$myDateTime = new DateTime('20-05-1991');

$worker = new Worker('jean', 'loulou', $myDateTime, 6688500712 , $myDateTime, 'expert', 'admin', 'admin');

$dbi = Singleton::getInstance()->getConnection();

$req = $dbi->prepare("INSERT INTO workers 
    (name, firstname, birthday, phone, dateHiring, status, login, password)
    VALUES
    (:name, :firstname, :birthday, :phone, :dateHiring, :status, :login, :password)");

$req->execute(array(
    'name' => $worker->getName(),
    'firstname' => $worker->getFirstname(),
    'birthday' => $worker->getBirthday()->format('Y-m-d'),
    'phone' => $worker->getPhone(),
    'dateHiring' => $worker->getDateHiring()->format('Y-m-d'),
    'status' => $worker->getStatus(),
    'login' => $worker->getLogin(),
    'password' => $worker->getPassword()
));

