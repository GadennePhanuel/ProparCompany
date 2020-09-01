<?php
require_once '../MODELE/Singleton.class.php';
require_once '../MODELE/DBManagement.class.php';
require_once '../MODELE/JobType.class.php';
require_once '../MODELE/Job.class.php';
require_once '../MODELE/Person.class.php';
require_once '../MODELE/Worker.class.php';
require_once '../MODELE/Customer.class.php';





$myDateTime = new DateTime('20-05-1991');

$worker = new Worker('jean', 'loulou', $myDateTime, '0688500712' , $myDateTime, 'expert', 'admin', 'admin');

$customer = new Customer('merlier', 'patrick', $myDateTime, "60 rue du tool", 'bailleul', 'merlierpat@gmail.com', '0691847461');

$jobtype = new JobType('petite', 1000);

$commentary = "doit être fait avant le 30 de ce mois";

DBManagement::addJob($customer, $commentary, 3);
