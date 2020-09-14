<?php
require_once 'config.php';

function checkEmailExist($email)
{
    global $dbh;
    $result = $dbh->prepare('SELECT id FROM users WHERE email = ?');
    $result->execute([$email]);
    $id = $result->fetchColumn();
    return $id;
}

function userSave($userData)
{
    global $dbh;
    $sql = 'INSERT INTO users(name, surname, age, birthday, email, country, city, address, skills, 
                                jobTitle, companyName, startDate, endDate)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
    $stm = $dbh->prepare($sql);
    $res = $stm->execute($userData);
    return $res;
}