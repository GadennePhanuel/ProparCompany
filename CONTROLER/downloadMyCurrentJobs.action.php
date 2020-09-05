<?php
session_start();
include_once '../vendor/autoload.php';
use ProparCompany\Singleton;

/*
 *  CONTROLLEUR POUR CHARGER UNIQUEMENT LES JOBS EN COURS DE L'EMPLOYE CONNECTE
 */



$dbi = Singleton::getInstance()->getConnection();

$req = $dbi->prepare("SELECT jobs.id_job, jobs.commentary, jobs.date_init, jobs.date_attributed, UPPER(customers.name) as nameCustomer, concat(UPPER(LEFT(customers.firstname,1)),LOWER(SUBSTRING(customers.firstname, 2, length(customers.firstname)))) as firstnameCustomer, customers.address, UPPER(customers.city) as cityCustomer, customers.email, customers.phone, concat(UPPER(LEFT(jobs_type.name,1)),LOWER(SUBSTRING(jobs_type.name, 2, length(jobs_type.name)))) as nameJobType
                                FROM jobs
                                INNER JOIN workers ON jobs.id_worker = workers.id_worker
                                INNER JOIN customers ON jobs.id_customer = customers.id_customer
                                INNER JOIN jobs_type ON jobs_type.id_jobType = jobs_type.id_jobType
                                WHERE login = :login AND jobs.status = 'attributed' AND jobs.id_jobType = jobs_type.id_jobType
                        ");

$req->execute([
    'login' => $_SESSION['login']
]);

$req = $req->fetchAll(\PDO::FETCH_ASSOC);

//echo '<pre>';
//var_dump($req);
//echo '<pre>';
echo json_encode($req);


