<?php
error_reporting(E_ALL);
require_once '../exercise4/DatabaseClass.php';

header('Content-Type: image/png');

$fileName = "image-123.png";

$im = imagecreatefrompng($fileName);
$grey = imagecolorallocate($im, 128, 128, 128);
$white = imagecolorallocate($im, 255, 255, 255);

$id = getIdImage($fileName);
$data = getInfoTitle($id);
$string = $data['string'];
$oldCount = $data['count'];

imagefill($im,0,0,$white);
imagestring($im, 5, 0, 0, $string, $grey);
imagepng($im);
imagedestroy($im);

turnCounter($id, $oldCount);

function getIdImage($name) {
    $strWithId = preg_replace('/[^0-9]/', '', $name);
    return $strWithId;
}

function getInfoTitle($id) {
    $db = Database::getInstance()->connect();
    $result = $db->prepare('SELECT string, count FROM title WHERE id = ?');
    $result->execute([$id]);
    $data = $result->fetch(PDO::FETCH_ASSOC);
    return $data;
}

function turnCounter($titleId, $oldValue) {
    $newValue = $oldValue + 1;
    saveNewCount($titleId, $newValue);
}

function saveNewCount($id, $count) {
    $db = Database::getInstance()->connect();
    $sql = "UPDATE title SET count = :count WHERE id = :id";
    $result = $db->prepare($sql);
    $result->bindParam(':id', $id, PDO::PARAM_INT);
    $result->bindParam(':count', $count, PDO::PARAM_STR);
    return $result->execute();
}
