<?php


class JobType
{
    private $idJobType; //int auto-increment en bdd
    private $nameType; //string
    private $price; //float

    public function __construct(String $name,Float $price)
    {
        $this->nameType = $name;
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getIdJobType()
    {
        return $this->idJobType;
    }

    /**
     * @param mixed $idJobType
     */
    public function setIdJobType($idJobType): void
    {
        $this->idJobType = $idJobType;
    }

    /**
     * @return String
     */
    public function getNameType(): string
    {
        return $this->nameType;
    }

    /**
     * @param String $nameType
     */
    public function setNameType(string $nameType): void
    {
        $this->nameType = $nameType;
    }

    /**
     * @return Float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param Float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

}

