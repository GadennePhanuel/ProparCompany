<?php


class JobType
{
    private int $idJobType; //int auto-increment en bdd
    private string $nameType; //string
    private float $price; //float

    public function __construct(String $name,float $price)
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

