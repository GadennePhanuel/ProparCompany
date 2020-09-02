<?php


class Customer extends Person
{
    private  $id_customer ; //int
    private  $address; //string
    private  $city; //string
    private  $email; //string
    private  $phone; //int

    public function __construct(string $name, string $firstname, DateTime $birthday, string $address, string $city, string $email, string $phone, $id_customer = NULL)
    {
        parent::__construct($name, $firstname, $birthday);
        $this->address = $address;
        $this->city = $city;
        $this->email = $email;
        $this->phone = $phone;
        $this->id_customer = NULL;
    }

    /**
     * @return mixed
     */
    public function getIdCustomer()
    {
        return $this->id_customer ;
    }

    /**
     * @param mixed $id_customer
     */
    public function setIdCustomer($id_customer ): void
    {
        $this->id_customer  = $id_customer ;
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