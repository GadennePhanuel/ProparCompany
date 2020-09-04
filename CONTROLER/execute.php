<?php
require_once '../vendor/autoload.php';
use ProparCompany\Factory;
use ProparCompany\Singleton;
use ProparCompany\DBManagement;
use ProparCompany\Customer;
/*
 * RECREATION D UN OBJET JOB SUITE A UN SELECT ALL DANS LA BDD
 */
//$dbi = Singleton::getInstance()->getConnection();
//$job = $dbi->prepare("SELECT *
//                                            FROM jobs
//                                            WHERE id_job = 1
//                                            ");
//
//$job->execute();
//
//$job = $job->fetchObject('ProparCompany\Job' );
//echo '<pre>';
//var_dump($job);
//echo '<pre>';

//$jobtype1 = Factory::getNewTypeJob('big', 10000);
//$jobtype2 = Factory::getNewTypeJob('medium', 2500);
//$jobtype3 = Factory::getNewTypeJob('little', 1000);
//
//DBManagement::createNewJobType($jobtype1);
//DBManagement::createNewJobType($jobtype2);
//DBManagement::createNewJobType($jobtype3);

$date1 = new DateTime('20-03-1995');
$date2 = new DateTime('01-01-2020');

$login1 ="théo";
$password1 = password_hash("blin", PASSWORD_DEFAULT);
$login2 = "manu";
$password2 = password_hash("tchao", PASSWORD_DEFAULT);
$login3 = "phanu";
$password3 = password_hash("gadenne", PASSWORD_DEFAULT);


$worker1 = Factory::getWorker('théo', 'blin', $date1, '0612121212', $date2, 'expert', $login1, $password1);
$worker2 = Factory::getWorker('Manû', 'tchaô', $date1, '0612121212', $date2, 'sénior', $login2, $password2);
$worker3 = Factory::getWorker('Phanu', 'gaden', $date1, '0612121212', $date2, 'apprenti', $login3, $password3);

DBManagement::createWorker($worker1);
DBManagement::createWorker($worker2);
DBManagement::createWorker($worker3);

//$customer1 = Factory::getCustomer('vigin', 'marie', $date1, '24 rue du tool', 'roubaix' , 'marei@gmail.com', '0312121212');
//$customer2 = Factory::getCustomer('bobo', 'ebeb', $date1, '74 rue du tool', 'roubaix' , 'ebeb@gmail.com', '010101010101');
//$customer3 = Factory::getCustomer('toto', 'goku', $date1, '96 rue du tool', 'roubaix' , 'goku@gmail.com', '4125369874');
//$customer4 = Factory::getCustomer('rara', 'tybu', $date1, '02 rue du tool', 'roubaix' , 'tybu@gmail.com', '4521036987');
//$customer5 = Factory::getCustomer('vava', 'ralele', $date1, '56 rue du tool', 'roubaix' , 'vava@gmail.com', '1236562389');

//DBManagement::createCustomer($customer1);
//DBManagement::createCustomer($customer2);
//DBManagement::createCustomer($customer3);
//DBManagement::createCustomer($customer4);
//DBManagement::createCustomer($customer5);


//DBManagement::addJob($customer1, "salut il m'faut plein de truc sviouxpléé", 2);
//DBManagement::addJob($customer1, "blébla super éfezfezfà", 1);
//DBManagement::addJob($customer1, "Interprétation plutôt malveillante des paroles ou des actes...", 3);
//DBManagement::addJob($customer1, "Exposé, analyse, interprétation d'une nouvelle, d'une information,...", 2);
//DBManagement::addJob($customer2, "salut il m'faut plein de truc sviouxpléé", 2);
//DBManagement::addJob($customer2, "Exposé, analyse, interprétation d'une nouvelle, d'une information,...", 1);
//DBManagement::addJob($customer2, "salut il m'faut plein de truc sviouxpléé", 1);
//DBManagement::addJob($customer3, "Exposé, analyse, interprétation d'une nouvelle, d'une information,...", 3);
//DBManagement::addJob($customer3, "salut il m'faut plein de truc sviouxpléé", 3);
//DBManagement::addJob($customer3, "Exposé, analyse, interprétation d'une nouvelle, d'une information,...", 3);
//DBManagement::addJob($customer4, "salut il m'faut plein de truc sviouxpléé", 1);
//DBManagement::addJob($customer4, "Exposé, analyse, interprétation d'une nouvelle, d'une information,...", 3);
//DBManagement::addJob($customer4, "Exposé par lequel on explique, on interprète, on juge un texte ...", 1);
//DBManagement::addJob($customer5, "commentèrent forme conjuguée du verbe commenter", 2);
//DBManagement::addJob($customer5, "Exposé, analyse, interprétation d'une nouvelle, d'une information, d'un match, d'une cérémonie, etc. : Le discours du président a donné lieu à des commentaires variés.
//", 3);
//DBManagement::addJob($customer5, "Exposé par lequel on explique, on interprète, on juge un texte ; notes et éclaircissements destinés à faciliter l'intelligence d'un texte : Commentaire littéraire, juridique.
//", 1);
//DBManagement::addJob($customer5, "En linguistique, partie de l'énoncé qui ajoute quelque chose de nouveau au thème, par opposition au topique.
//", 2);



