<?php
$dsn = 'mysql:dbname=web;host=127.0.0.1';
$user = 'admin';
$password = 'azuborev';
$dbh = null;
try {
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    $dbh->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
} catch (PDOException $e) {
    echo json_encode(header("HTTP/1.0 500"));
    die();
}
