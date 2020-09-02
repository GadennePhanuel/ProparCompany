<?php


class Worker extends Person
{
    private  $id_worker ; //int
    private  $phone; //int
    private  $dateHiring; //object Date  -- date d'embauche
    private  $status; //string
    private  $login; //string
    private  $password; //string

    public function __construct(string $name, string $firstname, DateTime $birthday, string $phone, DateTime $dateHiring, string $status, string $login, string $password, $id_worker = NULL )
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
        return $this->id_worker ;
    }

    /**
     * @param mixed id_worker
     */
    public function setIdWorker($id_worker ): void
    {
        $this->id_worker  = $id_worker ;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return DateTime
     */
    public function getDateHiring(): DateTime
    {
        return $this->dateHiring;
    }

    /**
     * @param DateTime $dateHiring
     */
    public function setDateHiring(DateTime $dateHiring): void
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