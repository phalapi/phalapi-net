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

// 样式调整
$rs = str_replace('<table>', '<table class="table table-bordered">', $rs);

$rs .= '<div style="float: left">
<h4>
<a href="http://qa.phalapi.net/">还有疑问？欢迎到社区提问！</a>
</h4>
</div>';

$folder = trim($argv[2]);
if (!is_dir($folder)) {
    mkdir($folder, 0777, true);
}

$info = pathinfo($file);

$header = file_get_contents(dirname(__FILE__) . '/header.html');
$header = str_replace('<title>', '<title>' . ($info['filename'] != 'index' ? $info['filename'] : '官方文档') . ' | ', $header);
// SEO优化
$header = str_replace('{keywords}', ',PHP接口框架,phalapi文档,phalapi wiki,PhalApi文档,phalapi在线文档,phalapi官方文档', $header);
$header = str_replace('{title}', $info['filename'], $header);

$footer = file_get_contents(dirname(__FILE__) . '/footer.html');

$_ds_id = md5($info['filename']);
$_ds_title = $info['filename'];
$_ds_url = 'http://www.phalapi.net/wikis/' . urlencode($info['filename']) . '.html';

$content = sprintf(
    "%s
    <div id=\"content\">
        <div class=\"container\">
            <div class=\"row row-md-flex row-md-flex-wrap\">
                %s
            </div>
        </div>
    </div>

 %s",
    $header, $rs , $footer 
);

file_put_contents($folder . '/' . $info['filename'] . '.html', $content);

