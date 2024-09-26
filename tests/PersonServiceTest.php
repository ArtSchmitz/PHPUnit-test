<?php

use PHPUnit\Framework\TestCase;
use App\Person;
use App\PersonService;

class PersonServiceTest extends TestCase
{

  private $service;
  private $person;

  protected function setUp(): void
  {
    $this->service = new PersonService();
    $this->person = new Person("John", "Doe", "john.doe@email.com", "Santa Catarina - SC", "M");
  }

  public function testGetAllPersonsSuccess()
  {
    $persons = $this->service->getAllPersons();
    $this->assertIsArray($persons);
    $this->assertCount(3, $persons);
  }

  public function testGetAllPersonsWhenListIsNullThrowsRuntimeException()
  {
    $reflection = new ReflectionClass($this->service);
    $property = $reflection->getProperty('persons');
    $property->setAccessible(true);
    $property->setValue($this->service, []);

    $this->expectException(RuntimeException::class);
    $this->expectExceptionMessage("Person list is empty");

    $this->service->getAllPersons();
  }

  public function testGetPersonByIdSuccess()
  {
    $person = $this->service->getPersonById(1);
    $this->assertInstanceOf(Person::class, $person);
    $this->assertEquals("John1", $person->firstName);
  }

  public function testGetPersonByInvalidIdThrowsIllegalArgumentException()
  {
    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage("Person not found with ID 99");

    $this->service->getPersonById(99);
  }

  public function testDeletePersonSuccess()
  {
    $this->service->deletePersonById(1);
    $this->expectException(InvalidArgumentException::class);
    $this->service->getPersonById(1);
  }
}
