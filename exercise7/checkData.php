<?php
require_once 'db/user.php';

function checkName($name) {
    if (empty($name) || strlen($name) < 2) {
        return 'Name can\'t be empty';
    }
    return null;
}

function checkSurname($surname) {
    if (empty($surname) || strlen($surname) < 2) {
        return 'Surname can\'t be empty';
    }
    return null;
}

function checkAge($age) {
    $regExAge = '/^(?:1[01][0-9]|100|1[7-9]|[2-9][0-9])$/';
    if (empty($age) || (preg_match($regExAge, $age) == FALSE)) {
        return 'Your age must be 18..100 years';
    }
    return null;
}

function checkEmail($email) {
    $regExEmail = '/[\w.\-]+@\w+(\.\w{2,})+/';
    if (empty($email) || (preg_match($regExEmail, $email) == FALSE)) {
        return 'It\'s not correct your email';
    }
    if (!empty(checkEmailExist($email))) {
        return 'Your email is not unique';
    }
    return null;
}

function checkCountryCity($country, $city) {
    if (empty($country)) {
        return 'Country can\'t be empty';
        if ($city) {
            return 'City can\'t be empty';
        }
    }
    return null;
}
