<?php
namespace ProparCompany;


class JobType
{
    private  $id_jobType ; //int auto-increment en bdd
    private  $name; //string
    private  $price; //float

    public function __construct()
    {

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



    /**
     * @return String
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param String $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

}

