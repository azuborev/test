<?php
error_reporting(E_ALL);
require_once '../exercise4/DatabaseClass.php';

header('Content-Type: image/png');

$fileName = "image-123.png";

$im = imagecreatefrompng($fileName);
$grey = imagecolorallocate($im, 128, 128, 128);
$white = imagecolorallocate($im, 255, 255, 255);

$id = getIdImage($fileName);
$string = getString($id);

imagefill($im,0,0,$white);
imagestring($im, 5, 0, 0, $string, $grey);

imagepng($im);
imagedestroy($im);

function getIdImage($name) {
    $strWithId = preg_replace('/[^0-9]/', '', $name);
    return $strWithId;
}

function getString($id) {
    $db = Database::getInstance()->connect();
    $statement = $db->prepare('SELECT string FROM title WHERE id = ?');
    $statement->execute([$id]);
    $string = $statement->fetch(PDO::FETCH_ASSOC);
    return $string['string'];
}

