<?php

namespace App;

class Person
{
  public $firstName;
  public $lastName;
  public $email;
  public $address;
  public $gender;

  public function __construct($firstName, $lastName, $email, $address, $gender)
  {
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->email = $email;
    $this->address = $address;
    $this->gender = $gender;
  }
}

class PersonService
{
  private $persons = [];

  public function __construct()
  {
    $this->persons[] = new Person("John0", "Doe", "john0.doe@email.com", "Santa Catarina - SC", "M");
    $this->persons[] = new Person("John1", "Doe", "john1.doe@email.com", "Santa Catarina - SC", "M");
    $this->persons[] = new Person("John2", "Doe", "john2.doe@email.com", "Santa Catarina - SC", "M");
  }

  public function getAllPersons()
  {
    if (empty($this->persons)) {
      throw new \RuntimeException("Person list is empty");
    }
    return $this->persons;
  }

  public function getPersonById($id)
  {
    if (!isset($this->persons[$id])) {
      throw new \InvalidArgumentException("Person not found with ID $id");
    }
    return $this->persons[$id];
  }

  public function deletePersonById($id)
  {
    if (!isset($this->persons[$id])) {
      throw new \InvalidArgumentException("Person not found with ID $id");
    }
    unset($this->persons[$id]);
  }
}
