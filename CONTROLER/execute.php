<?php
require_once '../MODELE/Singleton.class.php';
require_once '../MODELE/DBManagement.class.php';
require_once '../MODELE/JobType.class.php';
require_once '../MODELE/Job.class.php';
require_once '../MODELE/Person.class.php';
require_once '../MODELE/Worker.class.php';
require_once '../MODELE/Customer.class.php';

//$jobType1 = new JobType('grosse', 10000);
//$jobType2 = new JobType('moyenne', 2500);
//$jobType3 = new JobType('petite', 1000);
//
//DBManagement::createNewJobType($jobType1);
//DBManagement::createNewJobType($jobType2);
//DBManagement::createNewJobType($jobType3);


//$worker1 = new Worker('gadenne', 'phanuel', new DateTime('06-05-1991'), '0688500712', new DateTime('22-06-2020'), 'expert', 'phanu', 'admin');
//$worker2 = new Worker('fauconnier', 'thierry', new DateTime('16-03-1987'), '0645784512', new DateTime('01-01-2019'), 'senior', 'thierry', 'admin');
//$worker3 = new Worker('blin', 'théo', new DateTime('16-04-1996'), '0632659562', new DateTime('13-03-2020'), 'apprenti', 'théo', 'admin');
//
//DBManagement::createWorker($worker1);
//DBManagement::createWorker($worker2);
//DBManagement::createWorker($worker3);



//$customer1 = new Customer('andrée', 'yann', new DateTime('15-07-1998'), "64 rue kout", 'Lille', 'yann@yahoo.fr', '0784958495');
//$customer2 = new Customer('vigin', 'marie', new DateTime('16-05-2002'), "1614 route du gant", 'Roubaix', 'marie@yahoo.fr', '0542975630');
//$customer3 = new Customer('leroy', 'esteban', new DateTime('01-01-1996'), "22 vlà les flics", 'Tourcoin', 'esteban@yahoo.fr', '0154785963');



//DBManagement::createCustomer($customer1);
//DBManagement::createCustomer($customer2);
//DBManagement::createCustomer($customer3);

//
//DBManagement::addJob($customer1, "blabla c'est cool", 1);
//DBManagement::addJob($customer1, "blabla c'est super cool", 2);
//DBManagement::addJob($customer2, "bouuuuuuuuuuuuh", 1);
//DBManagement::addJob($customer3, "BANZAI", 3);
//DBManagement::addJob($customer3, "encore-BANZAI", 2);
//DBManagement::addJob($customer3, "encore-et-encore-BANZAI", 3);

//$dbi = Singleton::getInstance()->getConnection();
//
//$jobsList = $dbi->prepare("SELECT jobs.id_job,  jobs_type.name as nameTypeJob, jobs.date_init, customers.name, customers.firstname, jobs.commentary
//                                            FROM jobs
//                                            INNER JOIN customers ON jobs.id_customer = customers.id_customer
//                                            INNER JOIN jobs_type ON jobs_type.id_jobType = jobs.id_jobType
//                                            WHERE jobs.status = 'init'
//                                            ");
//
//$jobsList->execute();
//
//$jobsList = $jobsList->fetchAll(PDO::FETCH_ASSOC);
//echo '<pre>';
//var_dump($jobsList);
//echo '</pre>';

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
//$job = $job->fetchObject('Job' );
//
//var_dump($job);
//
$date1 = new DateTime('19-10-2020');

$custo = new Customer('nomm', 'phanu', $date1, 'rue du pik', 'bailleul', 'pakod@dsfds', '0615151515');

echo '<pre>';
var_dump($custo);
echo '</pre>';