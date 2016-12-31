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
$header = str_replace('<title>', '<title>' . $info['filename'] . ' | ', $header);
$header = str_replace(',PHP接口框架">', ',PHP接口框架,phalapi文档,phalapi wiki,PhalApi文档,phalapi在线文档,phalapi官方文档">', $header);

$footer = file_get_contents(dirname(__FILE__) . '/footer.html');

$_ds_id = md5($info['filename']);
$_ds_title = $info['filename'];
$_ds_url = 'http://www.phalapi.net/wikis/' . urlencode($info['filename']) . '.html';
$duoshuoComment =<<<EOT
<!-- 多说评论框 start -->
	<div class="ds-thread" data-thread-key="{$_ds_id}" data-title="{$_ds_title}" data-url="{$_ds_url}"></div>
<!-- 多说评论框 end -->
<!-- 多说公共JS代码 start (一个网页只需插入一次) -->
<script type="text/javascript">
var duoshuoQuery = {short_name:"phalapi"};
	(function() {
		var ds = document.createElement('script');
		ds.type = 'text/javascript';ds.async = true;
		ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
		ds.charset = 'UTF-8';
		(document.getElementsByTagName('head')[0] 
		 || document.getElementsByTagName('body')[0]).appendChild(ds);
	})();
	</script>
<!-- 多说公共JS代码 end -->
EOT;

$content = sprintf(
    "%s

    <div class=\"grid-wrapper\">
        <div class=\"grid\">
            <div class=\"grid__cell\">
                %s
            </div>
        </div>
    </div>

    %s
 %s",
    $header, $rs , $duoshuoComment, $footer 
);

file_put_contents($folder . '/' . $info['filename'] . '.html', $content);

