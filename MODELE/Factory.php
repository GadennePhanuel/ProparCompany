<?php
namespace ProparCompany;

class Factory
{
    public static function getCustomer(string $name, string $firstname, \DateTime $birthday, string $address, string $city, string $email, string $phone, $id_customer = NULL): Customer
    {
        return new Customer($name, $firstname, $birthday, $address,  $city,  $email,  $phone, $id_customer);
    }

    public static function getWorker(string $name, string $firstname, \DateTime $birthday, string $phone, \DateTime $dateHiring, string $status, string $login, string $password, $id_worker = NULL )
    {
        return new Worker($name, $firstname,  $birthday, $phone, $dateHiring, $status,  $login, $password, $id_worker );
    }

    public static function getNewTypeJob(string $name, float $price)
    {
        return new JobType($name, $price);
    }

    public static function getJob()
    {
        return new Job();
    }
}

