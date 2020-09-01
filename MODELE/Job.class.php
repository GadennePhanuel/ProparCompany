<?php


class Job
{
    private int $idJob; //int  - autoincrement bdd
    private string $commentary; //string
    private DateTime $dateInit; //date - de création du job
    private DateTime $dateAttributed; //date  - d'attribution du job à un employé
    private DateTime $dateEnd;  //date - de fin du job
    private string $status;  //string - status du job
    private int $idCustomer; //int
    private int $idWorker; //int
    private int $idJobType; //int

    public function __construct(int $idCustomer,string $commentary, int $idJobType)
    {
        $this->commentary = $commentary;
        $this->idCustomer = $idCustomer;
        $this->idJobType = $idJobType;
        $this->status = 'init';
    }

    /**
     * @return mixed
     */
    public function getIdJob()
    {
        return $this->idJob;
    }

    /**
     * @param mixed $idJob
     */
    public function setIdJob($idJob): void
    {
        $this->idJob = $idJob;
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
     * @return int
     */
    public function getIdCustomer(): int
    {
        return $this->idCustomer;
    }

    /**
     * @param int $idCustomer
     */
    public function setIdCustomer(int $idCustomer): void
    {
        $this->idCustomer = $idCustomer;
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
     * @return int
     */
    public function getIdJobType(): int
    {
        return $this->idJobType;
    }

    /**
     * @param int $idJobType
     */
    public function setIdJobType(int $idJobType): void
    {
        $this->idJobType = $idJobType;
    }


}
