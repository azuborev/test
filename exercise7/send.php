<?php

error_reporting( E_ERROR );
ini_set('display_errors', 1);
function handleError($errno, $errstr,$error_file,$error_line) {
//    http_response_code(500);
    $status = "invalid";
    $data = ['status' => $status, 'message' => 'Ошибка приложения.', 'errors' => []];
    echo json_encode($data);
    die();
}
//set error handler
set_error_handler("handleError");


require_once 'checkData.php';
require_once 'db/user.php';
require_once 'lib/mail.php';

define('ADMIN_MAIL', 'admin@admin.com');

$success = "Все прошло успешно";
$error = "Что-то пошло не так";
$skills = json_encode([$_POST['skill1'], $_POST['skill2'], $_POST['skill3'], $_POST['skill4'], $_POST['skill5']]);

$arrCheck = [
    checkName($_POST['name']),
    checkSurname($_POST['surname']),
    checkAge($_POST['age']),
    checkEmail($_POST['email']),
    checkCountryCity($_POST['country'], $_POST['city'] )
];
$arrError = [];
foreach ($arrCheck as $key => $value) {
    if ($value != null) {
        $arrError[] = $value;
    }
}
$userData = [
    'name' => $_POST['name'],
    'surname' => $_POST['surname'],
    'age' => $_POST['age'],
    'birthday' => $_POST['birthday'],
    'email' => $_POST['email'],
    'country' => $_POST['country'],
    'city' => $_POST['city'],
    'address' => $_POST['address'],
    'skills' => $skills,
    'jobTitle' => $_POST['jobTitle'],
    'companyName' => $_POST['companyName'],
    'startDate' => $_POST['startDate'],
    'endDate' => $_POST['endDate']
];

foreach ($userData as $key => $value) {
    $userData[$key] = (empty($value)) ? null : $value;
}

if (empty($arrError)) {
    try {
        userSave(array_values($userData));
        sendMail($userData);
        $status = 'valid';
        $message = $success;
        $data = ['status' => $status, 'message' => $message];
        echo json_encode($data);
    } catch (Exception $e) {
        $status = "invalid";
        $data = ['status' => $status, 'message' => 'Ошибка сохранения. 
                                        Попробуйте еще раз. '.$e->getMessage(), 'errors' => []];
        echo json_encode($data);
    }
} else {
    $status = "invalid";
    $data = ['status' => $status, 'message' => $error, 'errors' => $arrError];
    echo json_encode($data);
    die();
}

