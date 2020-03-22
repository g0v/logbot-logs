<?php
$basePath = dirname(__DIR__);
$timeBegin = strtotime('2013-07-26');
$timeEnd = time();
$author = 'kiang';
$authorLog = $basePath . '/logs/' . $author . '.csv';
$fh = fopen($authorLog, 'w');
fputcsv($fh, array('time', 'date', 'msg'));
for($timeCurrent = $timeBegin; $timeCurrent < $timeEnd; $timeCurrent += 86400) {
    $theDate = date('Y-m-d', $timeCurrent);
    $yearPath = $basePath . '/logs/' . date('Y', $timeCurrent);
    $targetFile = $yearPath . '/' . $theDate . '.json';
    if(file_exists($targetFile)) {
        $lines = json_decode(file_get_contents($targetFile), true);
        foreach($lines AS $line) {
            if($line['nick'] === $author) {
                fputcsv($fh, array($line['time'], $theDate, $line['msg']));
            }
        }
    }
}