<?php


class Person
{
    protected string $name; //sting
    protected string $firstname; //string
    protected DateTime $birthday; //date

    public function __construct(String $name, String $firstname, DateTime $birthday){
        $this->name = $name;
        $this->firstname = $firstname;
        $this->birthday = $birthday;
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
     * @return String
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param String $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return DateTime
     */
    public function getBirthday(): DateTime
    {
        return $this->birthday;
    }

    /**
     * @param DateTime $birthday
     */
    public function setBirthday(DateTime $birthday): void
    {
        $this->birthday = $birthday;
    }




}