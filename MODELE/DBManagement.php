<?php
namespace ProparCompany;


class DBManagement
{

    public static function createNewJobType(object $jobType): void
    {
        $dbi = Singleton::getInstance()->getConnection();
        $req = $dbi->prepare("INSERT INTO jobs_type (name, price) VALUES (:name, :price)");
        $req->execute(array(
            'name' => $jobType->getName(),
            'price' => $jobType->getPrice()
        ));
    }


    public static function createWorker(Worker $worker): void
    {
        $dbi = Singleton::getInstance()->getConnection();

        $req = $dbi->prepare("INSERT INTO workers 
                            (name, firstname, birthday, phone, dateHiring, status, login, password)
                            VALUES
                            (:name, :firstname, :birthday, :phone, :dateHiring, :status, :login, :password)");

        $req->execute(array(
            'name' =>$worker->getName(),
            'firstname' =>$worker->getFirstname(),
            'birthday' => $worker->getBirthday()->format('Y-m-d'),
            'phone' => $worker->getPhone(),
            'dateHiring' => $worker->getDateHiring()->format('Y-m-d'),
            'status' =>$worker->getStatus(),
            'login' => $worker->getLogin(),
            'password' => $worker->getPassword()
        ));
    }

    public static function modifyWorker(Worker $worker, $status): void
    {
        $dbi = Singleton::getInstance()->getConnection();

        $req = $dbi->prepare("UPDATE workers 
                                        SET
                                        status = :status
                                        WHERE 
                                        name = :name AND login = :login
                                        ");
        $req->execute(array(
            'name' => $worker->getName(),
            'login' =>$worker->getLogin(),
            'status' => $status
        ));
    }

    public static function deleteWorker(Worker $worker): void
    {
        $dbi = Singleton::getInstance()->getConnection();

        $req = $dbi->prepare("DELETE FROM workers                                         
                                        WHERE 
                                        name = :name AND login = :login
                                        ");
        $req->execute(array(
            'name' =>$worker->getName(),
            'login' =>$worker->getLogin(),
        ));
    }

    public static function createCustomer(object $customer): void
    {
        $dbi = Singleton::getInstance()->getConnection();
        $req = $dbi->prepare("INSERT INTO customers 
                            (name, firstname, birthday, address, city, email, phone) 
                            VALUES 
                            (:name, :firstname, :birthday, :address, :city, :email, :phone)");


        $req->execute(array(
            'name' => $customer->getName(),
            'firstname' =>$customer->getFirstname(),
            'birthday' => $customer->getBirthday()->format('Y-m-d'),
            'address' =>$customer->getAddress(),
            'city' => $customer->getCity(),
            'email' => $customer->getEmail(),
            'phone' => $customer->getPhone()
        ));
    }

    public static function addJob(int $id_customer, string $commentary, string $nameJobType): void
    {
        date_default_timezone_set('Europe/Paris');
        $date = date('d-m-Y');
        $currentDate = new \DateTime($date);

        $dbi = Singleton::getInstance()->getConnection();

        $id_jobType = $dbi->prepare("SELECT id_jobType FROM jobs_type WHERE name = :name");
        $id_jobType->execute([
            'name' => $nameJobType
        ]);
        $id_jobType = $id_jobType->fetch(\PDO::FETCH_ASSOC);


        $req = $dbi->prepare("INSERT INTO jobs
                            (commentary, id_jobType, id_customer, date_init, status)
                            VALUES
                            (:commentary, :id_jobType, :id_customer, :date_init, :status)");

        $req->execute(array(
            'commentary' => $commentary,
            'id_jobType' => $id_jobType['id_jobType'],
            'id_customer' => $id_customer,
            'date_init' => $currentDate->format('Y-m-d'),
            'status' => 'init'
        ));
    }

    public static function attributeJob(int $id_job, int $id_worker): void
    {


        $dbi = Singleton::getInstance()->getConnection();

        date_default_timezone_set('Europe/Paris');
        $date = date('d-m-Y');
        $currentDate = new \DateTime($date);

        $req = $dbi->prepare("UPDATE jobs
                            SET 
                            id_worker = :id_worker, date_attributed = :date_attributed, status = :status
                            WHERE
                            id_job = :id_job
                            ");

        $req->execute(array(
            'status' => 'attributed',
            'id_job' => $id_job,
            'id_worker' => $id_worker,
            'date_attributed' => $currentDate->format('Y-m-d'),
        ));
    }

    public static function endJob(int $id_job): bool
    {


        $dbi = Singleton::getInstance()->getConnection();

        date_default_timezone_set('Europe/Paris');
        $date = date('d-m-Y');
        $currentDate = new \DateTime($date);

        $req = $dbi->prepare("UPDATE jobs
                            SET 
                            date_end = :date_end, status = :status
                            WHERE
                            id_job = :id_job
                            ");

        $req->execute(array(
            'status' => 'finish',
            'id_job' => $id_job,
            'date_end' => $currentDate->format('Y-m-d'),
        ));
        return true;
    }


    public static function displayJobNotAttributed(): array
    {
        $dbi = Singleton::getInstance()->getConnection();

        $jobsList = $dbi->prepare("SELECT jobs.id_job,  jobs_type.name as nameType, jobs.date_init, customers.name, customers.firstname, jobs.commentary
                                            FROM jobs
                                            INNER JOIN customers ON jobs.id_customer = customers.id_customer
                                            INNER JOIN jobs_type ON jobs_type.id_jobType = jobs.id_jobType
                                            WHERE jobs.status = 'init'
                                            ORDER BY jobs.date_init
                                            ");

        $jobsList->execute();

        $jobsList = $jobsList->fetchAll(\PDO::FETCH_ASSOC);

        return $jobsList;
    }

    public static function displayJobInProgress(): array
    {
        $dbi = Singleton::getInstance()->getConnection();

        $jobsList = $dbi->prepare("SELECT jobs.id_job,  jobs_type.name as nameType, jobs.date_init, jobs.date_attributed ,customers.name, customers.firstname, jobs.commentary, workers.name as nameWorker, workers.firstname as firstnameWorker
                                            FROM jobs
                                            INNER JOIN customers ON jobs.id_customer = customers.id_customer
                                            INNER JOIN jobs_type ON jobs_type.id_jobType = jobs.id_jobType
                                            INNER JOIN workers ON jobs.id_worker = workers.id_worker
                                            WHERE jobs.status = 'attributed'
                                            ORDER BY jobs.date_init
                                            ");

        $jobsList->execute();

        $jobsList = $jobsList->fetchAll(\PDO::FETCH_ASSOC);

        return $jobsList;
    }

    public static function displayJobEnd(): array
    {
        $dbi = Singleton::getInstance()->getConnection();

        $jobsList = $dbi->prepare("SELECT jobs.id_job,  jobs_type.name as nameType, jobs.date_init, jobs.date_attributed, jobs.date_end, jobs.date_end, customers.name, customers.firstname, jobs.commentary, workers.name as nameWorker, workers.firstname as firstnameWorker
                                            FROM jobs
                                            INNER JOIN customers ON jobs.id_customer = customers.id_customer
                                            INNER JOIN jobs_type ON jobs_type.id_jobType = jobs.id_jobType
                                            INNER JOIN workers ON jobs.id_worker = workers.id_worker
                                            WHERE jobs.status = 'finish'
                                            ORDER BY jobs.date_init
                                            ");

        $jobsList->execute();

        $jobsList = $jobsList->fetchAll(\PDO::FETCH_ASSOC);

        return $jobsList;
    }

}

