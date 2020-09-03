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

//$date1 = new DateTime('10-02-2020');
//$customer = Factory::getCustomer('name', 'phanu', $date1, 'dsdsf', 'fdsf', 'fdsfsdf', '01515210');
//var_dump($customer);

//$dbi = Singleton::getInstance()->getConnection();
//
//$jobsList = $dbi->prepare("SELECT jobs.id_job,  jobs_type.name, jobs.date_init, customers.name, customers.firstname, jobs.commentary
//                                            FROM jobs
//                                            INNER JOIN customers ON jobs.id_customer = customers.id_customer
//                                            INNER JOIN jobs_type ON jobs_type.id_jobType = jobs.id_jobType
//                                            WHERE jobs.status = 'attributed'
//                                            ");
//
//$jobsList->execute();
//
//$jobsList = $jobsList->fetchAll(PDO::FETCH_ASSOC);
//echo '<pre>';
//var_dump($jobsList);
//echo '<pre>';


//$date3 = new DateTime('01/01/1995');
//
//$custo = new Customer('blin', 'theo', $date3, '65 rue du four', 'Lille', 'theo@yahoo.fr', '0694618487');
//DBManagement::createCustomer($custo);
//DBManagement::addJob($custo, 'salut phanu je te fais bosser !!!!', 1);
//
