<?php
error_reporting(E_ALL);
require_once '../exercise4/DatabaseClass.php';

header('Content-Type: image/png');
$id = $_GET['id'];
$fileName = "image-".$id.".png";

$im = imagecreatefrompng($fileName);
$grey = imagecolorallocate($im, 128, 128, 128);
$white = imagecolorallocate($im, 255, 255, 255);

$data = getInfoTitle($id);

$oldCount = $data['count'];
$string = $data['string'];

imagefill($im,0,0,$white);
imagestring($im, 5, 0, 0, $string, $grey);
imagepng($im);
imagedestroy($im);

turnCounter($id, $oldCount); //update counter

function getInfoTitle($id) {
    $db = Database::getInstance()->connect();
    $result = $db->prepare('SELECT string, count FROM title WHERE id = ?');
    $result->execute([$id]);
    $data = $result->fetch(PDO::FETCH_ASSOC);
    return $data;
}

function turnCounter($titleId, $oldValue) {
    $oldValue++;
    saveNewCount($titleId, $oldValue);
}

function saveNewCount($id, $count) {
    $db = Database::getInstance()->connect();
    $sql = "UPDATE title SET count = :count WHERE id = :id";
    $result = $db->prepare($sql);
    $result->bindParam(':id', $id, PDO::PARAM_INT);
    $result->bindParam(':count', $count, PDO::PARAM_STR);
    return $result->execute();
}
