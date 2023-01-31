<?php

foreach (glob("/home/srwang/.irssi/irclog/freenode.#g0v.tw.*.gz") as $f) {
    $fp = gzopen($f, 'r');
    while (false !== ($line = fgets($fp))) {
        if (strpos($line, '---') === 0) {
            if (preg_match('#--- Log opened .* (\d+)月 (\d+) \d+:\d+:\d+ (\d+)#', $line, $matches)) {
                list(, $month, $day, $year) = $matches;
            } elseif (preg_match('#--- Day changed .* (\d+)月 (\d+) (\d+)#', $line, $matches)) {
                list(, $month, $day, $year) = $matches;
            } elseif (preg_match('#--- Log closed.*#', $line)) {
                continue;
            } else {
                var_dump($line);
                exit;
            }

            if (!file_exists($year)) {
                mkdir($year);
            }
            $target = sprintf("%d/%d-%02d-%02d.txt", $year, $year, $month, $day);
        }
        file_put_contents($target, $line, FILE_APPEND);
    }
}
