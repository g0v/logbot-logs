<?php
$basePath = dirname(__DIR__);
$timeBegin = strtotime('2013-07-26');
$timeEnd = time();

for($timeCurrent = $timeBegin; $timeCurrent < $timeEnd; $timeCurrent += 86400) {
    $theDate = date('Y-m-d', $timeCurrent);
    $yearPath = $basePath . '/logs/' . date('Y', $timeCurrent);
    if(!file_exists($yearPath)) {
        mkdir($yearPath, 0777, true);
    }
    $targetFile = $yearPath . '/' . $theDate . '.json';
    if(!file_exists($targetFile)) {
        file_put_contents($targetFile, file_get_contents('https://logbot.g0v.tw/channel/g0v.tw/' . $theDate . '/json'));
    }
}