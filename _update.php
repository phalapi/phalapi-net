<?php

$rs = shell_exec("git pull");

file_put_contents('./_udpate.log', date("Y-m-d H:i:s") . "\n" . $rs . "\n\n", FILE_APPEND);
echo $rs , "\n\n";

echo "ok";