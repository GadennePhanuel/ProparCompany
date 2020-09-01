<?php


class Customer extends Person
{
    private int $idCustomer; //int
    private string $address; //string
    private string $city; //string
    private string $email; //string
    private string $phone; //int

    public function __construct(string $name, string $firstname, DateTime $birthday, string $address, string $city, string $email, string $phone)
    {
        parent::__construct($name, $firstname, $birthday);
        $this->address = $address;
        $this->city = $city;
        $this->email = $email;
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getIdCustomer()
    {
        return $this->idCustomer;
    }

    /**
     * @param mixed $idCustomer
     */
    public function setIdCustomer($idCustomer): void
    {
        $this->idCustomer = $idCustomer;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
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



}