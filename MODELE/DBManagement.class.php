<?php


class DBManagement
{

    public static function createNewJobType(object $jobType){
        $dbi = Singleton::getInstance()->getConnection();
        $req = $dbi->prepare("INSERT INTO jobs_type (name, price) VALUES (:name, :price)");
        $req->execute(array(
            'name' => $jobType->getNameType(),
            'price' => $jobType->getPrice()
        ));
    }

    public static function createCustomer(object $customer){
        $dbi = Singleton::getInstance()->getConnection();
        $req = $dbi->prepare("INSERT INTO customers (name, firstname, birthday, address, city, email, phone) VALUES (:name, :firstname, :birthday, :address, :city, :email, :phone)");
        $req->execute(array(
            'name' => $customer->getName(),
            'firstname' => $customer->getFirstname(),
            'birthday' => $customer->getBirthday(),
            'address' => $customer->getAddress(),
            'city' => $customer->getCity(),
            'email' => $customer->getEmail(),
            'phone' => $customer->getPhone()
        ));
    }

    public static function createWorker(Worker $worker){
        $dbi = Singleton::getInstance()->getConnection();
        $req = $dbi->prepare("INSERT INTO workers (name, firstname, birthday, phone, dateHiring, status, login, password) VALUES (:name, :firstname, :birthday, :phone, :dateHiring, :status, :login, :password)");
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
    }
}