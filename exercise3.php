<?php
interface UserInterface
{
    public function hasCompletedEducation();
    public function hasHigh();
    public function __set($property, $value);
    public function __get($property);
}

abstract class User implements UserInterface
{
    private  $firstName;
    private  $secondName;
    private  $age;
    private  $gender;
    private  $phone;
    private  $email;

    public function __construct($firstName, $secondName, $age, $gender, $phone, $email)
    {
        $this->firstName = $firstName;
        $this->secondName =$secondName;
        $this->age = $age;
        $this->gender = $gender;
        $this->phone = $phone;
        $this->email = $email;
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
        return null;
    }
}

final class Student extends User
{
    private $course;
    private $university;
    private $studentship;

    public function __construct($firstName, $secondName, $age, $gender, $phone, $email,
                                $course, $university, $studentship)
    {
        parent::__construct($firstName, $secondName, $age, $gender, $phone, $email);
        $this->course = $course;
        $this->university =$university;
        $this->studentship = $studentship;
    }

    public function hasCompletedEducation()
    {
        return false;
    }
    public function hasHigh()
    {
        return false;
    }
}

abstract class Worker extends User
{
    private $experience;
    private $company;
    private $position;
    private $salary;

    public function __construct($firstName, $secondName, $age, $gender, $phone, $email,
                                $experience, $company, $position, $salary)
    {
        parent::__construct($firstName, $secondName, $age, $gender, $phone, $email);
        $this->experience = $experience;
        $this->company =$company;
        $this->position = $position;
        $this->salary = $salary;
    }

    public function hasCompletedEducation()
    {
        return true;
    }
}

class Developer extends Worker
{
    private $programLanguages;

    public function __construct($firstName, $secondName, $age, $gender, $phone, $email,
                                $experience, $company, $position, $salary, $programLanguages)
    {
        parent::__construct($firstName, $secondName, $age, $gender, $phone, $email,
            $experience, $company, $position, $salary);
        $this->programLanguages = $programLanguages;
    }

    public function hasHigh()
    {
        return true;
    }
}
