<?php
namespace ProparCompany;


class Job
{
    private $id_job ; //int  - autoincrement bdd
    private  $commentary; //string
    private  $dateInit; //date - de création du job
    private  $dateAttributed; //date  - d'attribution du job à un employé
    private  $dateEnd;  //date - de fin du job
    private  $status;  //string - status du job
    private  $id_customer ; //int
    private  $id_worker ; //int
    private  $id_jobType ; //int

    public function __construct()
    {
        $this->dateInit = new \DateTime($this->dateInit);
        if ($this->dateAttributed != null){
            $this->dateAttributed = new \DateTime($this->dateAttributed);
        }
        if ($this->dateEnd != null){
            $this->dateEnd = new \DateTime($this->dateEnd);
        }
    }

    /**
     * @return mixed
     */
    public function getIdJob()
    {
        return $this->id_job;
    }

    /**
     * @param mixed $id_job
     */
    public function setIdJob($id_job): void
    {
        $this->id_job = $id_job;
    }



    /**
     * @return string
     */
    public function getCommentary(): string
    {
        return $this->commentary;
    }

    /**
     * @param string $commentary
     */
    public function setCommentary(string $commentary): void
    {
        $this->commentary = $commentary;
    }

    /**
     * @return mixed
     */
    public function getDateInit()
    {
        return $this->dateInit;
    }

    /**
     * @param mixed $dateInit
     */
    public function setDateInit($dateInit): void
    {
        $this->dateInit = $dateInit;
    }

    /**
     * @return mixed
     */
    public function getDateAttributed()
    {
        return $this->dateAttributed;
    }

    /**
     * @param mixed $dateAttributed
     */
    public function setDateAttributed($dateAttributed): void
    {
        $this->dateAttributed = $dateAttributed;
    }

    /**
     * @return mixed
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * @param mixed $dateEnd
     */
    public function setDateEnd($dateEnd): void
    {
        $this->dateEnd = $dateEnd;
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
     * @return mixed
     */
    public function getIdCustomer()
    {
        return $this->id_customer;
    }

    /**
     * @param mixed $id_customer
     */
    public function setIdCustomer($id_customer): void
    {
        $this->id_customer = $id_customer;
    }

    /**
     * @return mixed
     */
    public function getIdWorker()
    {
        return $this->id_worker;
    }

    /**
     * @param mixed $id_worker
     */
    public function setIdWorker($id_worker): void
    {
        $this->id_worker = $id_worker;
    }

    /**
     * @return mixed
     */
    public function getIdJobType()
    {
        return $this->id_jobType;
    }

    /**
     * @param mixed $id_jobType
     */
    public function setIdJobType($id_jobType): void
    {
        $this->id_jobType = $id_jobType;
    }



}
