<?php


class Person
{
    protected $name; //sting
    protected $firstname; //string
    protected $birthday; //date

    public function __construct(String $name, String $firstname, object $birthday){
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
     * @return object
     */
    public function getBirthday(): object
    {
        return $this->birthday;
    }

    /**
     * @param object $birthday
     */
    public function setBirthday(object $birthday): void
    {
        $this->birthday = $birthday;
    }


}