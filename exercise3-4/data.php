<?php
require_once 'DatabaseClass.php';
require_once 'UserClass.php';

// создаем таблицу
$db_table = Database::getInstance()->connect();
$sql = "CREATE TABLE students (
                id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                firstName VARCHAR(30) NOT NULL,
                secondName VARCHAR(30) NOT NULL,
                age TINYINT(3) NOT NULL,
                gender ENUM('m', 'w') NOT NULL,
                phone INT(10) NOT NULL,
                email VARCHAR(50) NOT NULL,
                course VARCHAR(30) NOT NULL,
                university VARCHAR(30) NOT NULL,
                studentship INT(5) DEFAULT 0)
                ";
$db_table->exec($sql);

// создаем 10 случайных студентов
$studentsList = [];
for ($i = 1; $i <= 10; $i++) {
    $student = createRandomStudent();
    $studentsList[] = $student;
}

//сохраняем в БД
saveStudents($studentsList);


function createRandomStudent()
{
    $data = getRandomData();
    return createStudent($data);
    ;
}

function getRandomData()
{
    $namesList = ['Ivan', 'Lisa', 'Misha', 'Vasiliy', 'Sergei', 'Sasha', 'Petya', 'Sveta', 'Alena', 'Yurii'];
    $secondnamesList = ['Ivanov', 'Petrov', 'Sidorov', 'But', 'Semko', 'Blohin', 'Alba', 'Aliev', 'Sergeev', 'Vasin'];
    $genderList = 'mw';
    $courseList = '123456';
    $univerList = ['HAI', 'KPI', 'UkrSurt', 'Karazina', 'Hnure', 'Med', 'UIPA'];

    $name = $namesList[rand(0, count($namesList) - 1)];
    $secondName = $secondnamesList[rand(0, count($secondnamesList) - 1)];
    $age = rand(16, 23);
    $gender = substr(str_shuffle($genderList), 0, 1);
    $phone = rand(1000000, 9999999);
    $email = $namesList[rand(0, count($namesList) - 1)] . '@mail.com';
    $course = substr(str_shuffle($courseList), 0, 1);
    $univer = $univerList[rand(0, count($univerList) - 1)];
    $studentship = random_int(1000, 2000);

    $data = [
        'firstName' => $name,
        'secondName' => $secondName,
        'age' => $age,
        'gender' => $gender,
        'phone' => $phone,
        'email' => $email,
        'course' => $course,
        'university' => $univer,
        'studentship' => $studentship
    ];
    return $data;
}

function createStudent($data)
{
    $student = new Student($data['firstName'], $data['secondName'], $data['age'], $data['gender'], $data['phone'],
        $data['email'], $data['course'], $data['university'], $data['studentship']);
    return $student;
}

function saveStudents($studentsList)
{
    $db = Database::getInstance()->connect();
    $sql = 'INSERT INTO students(firstName, secondName, age, gender, phone, email, course, university, studentship)
                    VALUES (:firstName, :secondName, :age, :gender, :phone, :email, :course, :university, :studentship)';

    $statement = $db->prepare($sql);

    foreach ($studentsList as $student) {
        $statement->bindValue(':firstName', $student->firstName, PDO::PARAM_STR);
        $statement->bindValue(':secondName', $student->secondName, PDO::PARAM_STR);
        $statement->bindValue(':age', $student->age, PDO::PARAM_INT);
        $statement->bindValue(':gender', $student->gender, PDO::PARAM_STR);
        $statement->bindValue(':phone', $student->phone, PDO::PARAM_INT);
        $statement->bindValue(':email', $student->email, PDO::PARAM_STR);
        $statement->bindValue(':course', $student->course, PDO::PARAM_STR);
        $statement->bindValue(':university', $student->university, PDO::PARAM_STR);
        $statement->bindValue(':studentship', $student->studentship, PDO::PARAM_INT);
        $statement->execute();;
    }
}
