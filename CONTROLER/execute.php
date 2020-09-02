<?php
require_once '../vendor/autoload.php';
use ProparCompany\Factory;
use ProparCompany\Singleton;

/*
 * RECREATION D UN OBJET JOB SUITE A UN SELECT ALL DANS LA BDD
 */
$dbi = Singleton::getInstance()->getConnection();
$job = $dbi->prepare("SELECT *
                                            FROM jobs
                                            WHERE id_job = 1
                                            ");

$job->execute();

$job = $job->fetchObject('ProparCompany\Job' );
echo '<pre>';
var_dump($job);
echo '<pre>';

//$date1 = new DateTime('10-02-2020');
//$customer = Factory::getCustomer('name', 'phanu', $date1, 'dsdsf', 'fdsf', 'fdsfsdf', '01515210');
//var_dump($customer);