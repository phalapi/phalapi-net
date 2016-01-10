#!/usr/bin/env php

<?php
/**
 * @author dogstar 20150408
 */

if ($argc < 3) {
    echo "Usage: $argv[0] <md_file> <save_folder> \n\n";
    exit(1);
}

$file = trim($argv[1]);
if (!file_exists($file)) {
    echo "Miss $file !\n\n";
    exit(2);
}

require_once dirname(__FILE__) . '/../Parsedown.php';

$Parsedown = new Parsedown();

$rs = $Parsedown->text(file_get_contents($file));

$folder = trim($argv[2]);
if (!is_dir($folder)) {
    mkdir($folder, 0777, true);
}

$info = pathinfo($file);

$header = file_get_contents(dirname(__FILE__) . '/header.html');
$header = str_replace('<title>', '<title>' . $info['filename'] . ' | ', $header);
$header = str_replace(',PHP接口框架">', ',PHP API framework,phalapi docs,phalapi wiki,PhalApi manu,phalapi wikis,phalapi">', $header);

$footer = file_get_contents(dirname(__FILE__) . '/footer.html');

$content = sprintf(
    "%s

    <div class=\"grid-wrapper\">
        <div class=\"grid\">
            <div class=\"grid__cell\">
                %s
            </div>
        </div>
    </div>
    
 %s",
    $header, $rs , $footer 
);

file_put_contents($folder . '/' . $info['filename'] . '.html', $content);

