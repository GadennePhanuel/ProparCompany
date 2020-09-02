<?php


class DBManagement
{

    public static function createNewJobType(array $jobType): void
    {
        $dbi = Singleton::getInstance()->getConnection();
        $req = $dbi->prepare("INSERT INTO jobs_type (name, price) VALUES (:name, :price)");
        $req->execute(array(
            'name' => iconv("UTF-8", "Windows-1252",$jobType->getNameType()),
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
            'name' => iconv("UTF-8", "Windows-1252",$worker->getName()),
            'firstname' => iconv("UTF-8", "Windows-1252",$worker->getFirstname()),
            'birthday' => $worker->getBirthday()->format('Y-m-d'),
            'phone' => $worker->getPhone(),
            'dateHiring' => $worker->getDateHiring()->format('Y-m-d'),
            'status' => iconv("UTF-8", "Windows-1252",$worker->getStatus()),
            'login' => iconv("UTF-8", "Windows-1252",$worker->getLogin()),
            'password' => iconv("UTF-8", "Windows-1252",$worker->getPassword())
        ));
    }

    public static function modifyWorker(Worker $worker, $status): void
    {
        $dbi = Singleton::getInstance()->getConnection();

        $req = $dbi->prepare("UPDATE workers 
                                        SET
                                        (status = :status)
                                        WHERE 
                                        name = :name AND login = :login
                                        ");
        $req->execute(array(
            'name' => $worker->getName(),
            'login' => $worker->getLogin(),
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
            'name' => $worker->getName(),
            'login' => $worker->getLogin(),
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
            'name' => iconv("UTF-8", "Windows-1252",$customer->getName()),
            'firstname' => iconv("UTF-8", "Windows-1252",$customer->getFirstname()),
            'birthday' => $customer->getBirthday()->format('Y-m-d'),
            'address' => iconv("UTF-8", "Windows-1252",$customer->getAddress()),
            'city' => iconv("UTF-8", "Windows-1252",$customer->getCity()),
            'email' => $customer->getEmail(),
            'phone' => $customer->getPhone()
        ));
    }

    public static function addJob(Customer $customer, string $commentary, int $idJobType): void
    {
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
            'commentary' => iconv("UTF-8", "Windows-1252",$commentary),
            'id_jobType' => $idJobType,
            'id_customer' => $id_customer['id_customer'],
            'date_init' => $currentDate->format('Y-m-d'),
            'status' => 'init'
        ));
    }

    public static function attributeJob(Job $job, string $login): void     //le login de l'employé connecté est enregistrer dans la session donc on peut s'en servir pour aller chercher son id
    {
        //on doit bien sur reconstruire l'objet $job à partir de la bdd, quand le tableau d'affichage s'autogénere avec chacun un boutton en fin de ligne pour se l'attribuer, le boutton value = id_job

        $dbi = Singleton::getInstance()->getConnection();

        date_default_timezone_set('Europe/Paris');
        $date = date('d-m-Y');
        $currentDate = new DateTime($date);

        $req = $dbi->prepare("UPDATE jobs
                            SET 
                            (id_worker = :id_worker, date_attributed = :date_attributed)
                            WHERE
                            (id_job = :id_job)
                            ");

        $req->execute(array(
            'id_job' => $job->getIdJob(),
            'id_worker' => $id_worker,
            'date_attributed' => $currentDate->format('Y-m-d'),
        ));
    }

    public static function displayJobNotAttributed(): array
    {
        $dbi = Singleton::getInstance()->getConnection();

        $jobsList = $dbi->prepare("SELECT jobs.id_job,  jobs_type.name, jobs.date_init, customers.name, customers.firstname, jobs.commentary
                                            FROM jobs
                                            INNER JOIN customers ON jobs.id_customer = customers.id_customer
                                            INNER JOIN jobs_type ON jobs_type.id_jobType = jobs.id_jobType
                                            WHERE jobs.status = 'init'
                                            ");

        $jobsList->execute();

        $jobsList = $jobsList->fetchAll(PDO::FETCH_ASSOC);

        return $jobsList;
    }

    public static function displayJobInProgress(): array
    {
        $dbi = Singleton::getInstance()->getConnection();

        $jobsList = $dbi->prepare("SELECT jobs.id_job,  jobs_type.name, jobs.date_init, customers.name, customers.firstname, jobs.commentary
                                            FROM jobs
                                            INNER JOIN customers ON jobs.id_customer = customers.id_customer
                                            INNER JOIN jobs_type ON jobs_type.id_jobType = jobs.id_jobType
                                            WHERE jobs.status = 'attributed'
                                            ");

        $jobsList->execute();

        $jobsList = $jobsList->fetchAll(PDO::FETCH_ASSOC);

        return $jobsList;
    }

    public static function displayJobEnd(): array
    {
        $dbi = Singleton::getInstance()->getConnection();

        $jobsList = $dbi->prepare("SELECT jobs.id_job,  jobs_type.name, jobs.date_init, customers.name, customers.firstname, jobs.commentary
                                            FROM jobs
                                            INNER JOIN customers ON jobs.id_customer = customers.id_customer
                                            INNER JOIN jobs_type ON jobs_type.id_jobType = jobs.id_jobType
                                            WHERE jobs.status = 'finish'
                                            ");

        $jobsList->execute();

        $jobsList = $jobsList->fetchAll(PDO::FETCH_ASSOC);

        return $jobsList;
    }

}