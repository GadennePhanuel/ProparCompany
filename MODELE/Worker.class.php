<?php


class Worker extends Person
{
    private $idWorker; //int
    private $phone; //int
    private $dateHiring; //object Date  -- date d'embauche
    private $status; //string
    private $login; //string
    private $password; //string

    public function __construct(string $name, string $firstname, DateTime $birthday, int $phone, DateTime $dateHiring, string $status, string $login, string $password)
    {
        parent::__construct($name, $firstname, $birthday);
        $this->phone = $phone;
        $this->dateHiring = $dateHiring;
        $this->status = $status;
        $this->login = $login;
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getIdWorker()
    {
        return $this->idWorker;
    }

    /**
     * @param mixed $idWorker
     */
    public function setIdWorker($idWorker): void
    {
        $this->idWorker = $idWorker;
    }

    /**
     * @return string
     */
    public function getPhone(): int
    {
        return $this->phone;
    }

    /**
     * @param int $phone
     */
    public function setPhone(int $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return object
     */
    public function getDateHiring(): object
    {
        return $this->dateHiring;
    }

    /**
     * @param object $dateHiring
     */
    public function setDateHiring(object $dateHiring): void
    {
        $this->dateHiring = $dateHiring;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }


}