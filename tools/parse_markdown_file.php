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

require_once dirname(__FILE__) . '/Parsedown.php';

$Parsedown = new Parsedown();

$rs = $Parsedown->text(file_get_contents($file));

$folder = trim($argv[2]);
if (!is_dir($folder)) {
    mkdir($folder, 0777, true);
}

$info = pathinfo($file);

$header = file_get_contents(dirname(__FILE__) . '/header.html');
$header = str_replace('<title>', '<title>' . ($info['filename'] != 'index' ? $info['filename'] : '官方文档') . ' | ', $header);
$header = str_replace(',PHP接口框架">', ',PHP接口框架,phalapi文档,phalapi wiki,PhalApi文档,phalapi在线文档,phalapi官方文档">', $header);

$footer = file_get_contents(dirname(__FILE__) . '/footer.html');

$_ds_id = md5($info['filename']);
$_ds_title = $info['filename'];
$_ds_url = 'http://www.phalapi.net/wikis/' . urlencode($info['filename']) . '.html';
// 多说，换友言
$duoshuoComment = <<<EOT
<!-- UY BEGIN -->
<div id="uyan_frame"></div>
<script type="text/javascript" src="http://v2.uyan.cc/code/uyan.js?uid=2128651"></script>
<!-- UY END -->
EOT;
$duoshuoComment = '<!-- TODO -->';

$content = sprintf(
    "%s

    <div class=\"grid-wrapper\">
        <div class=\"grid\">
            <div class=\"grid__cell\">
                %s
            </div>
        </div>

        <div class=\"grid\">
            <div class=\"grid__cell\">
                %s
            </div>
        </div>
    </div>

 %s",
    $header, $rs , $duoshuoComment, $footer 
);

file_put_contents($folder . '/' . $info['filename'] . '.html', $content);

