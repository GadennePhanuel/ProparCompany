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


    public static function createWorker(Worker $worker){
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
    }

    public static function createCustomer(object $customer){
        $dbi = Singleton::getInstance()->getConnection();
        $req = $dbi->prepare("INSERT INTO customers 
                            (name, firstname, birthday, address, city, email, phone) 
                            VALUES 
                            (:name, :firstname, :birthday, :address, :city, :email, :phone)");


        $req->execute(array(
            'name' => $customer->getName(),
            'firstname' => $customer->getFirstname(),
            'birthday' => $customer->getBirthday()->format('Y-m-d'),
            'address' => $customer->getAddress(),
            'city' => $customer->getCity(),
            'email' => $customer->getEmail(),
            'phone' => $customer->getPhone()
        ));
    }

    public static function addJob(Customer $customer, string $commentary, int $idJobType){
        date_default_timezone_set('Europe/Paris');
        $date = date('d-m-Y');
        $currentDate = new DateTime($date);

        $dbi = Singleton::getInstance()->getConnection();

        $id_customer = $dbi->prepare("SELECT id_customer FROM customers WHERE name = :name AND email = :email");
        $id_customer->execute([
            'name' => $customer->getName(),
            'email' => $customer->getEmail()
        ]);
        $id_customer = $id_customer->fetch(PDO::FETCH_ASSOC);


        $req = $dbi->prepare("INSERT INTO jobs
                            (commentary, id_jobType, id_customer, date_init, status)
                            VALUES
                            (:commentary, :id_jobType, :id_customer, :date_init, :status)");

        $req->execute(array(
            'commentary' => $commentary,
            'id_jobType' => $idJobType,
            'id_customer' => $id_customer['id_customer'],
            'date_init' => $currentDate->format('Y-m-d'),
            'status' => 'init'
        ));
    }



}