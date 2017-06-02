#!/bin/basn/env php
<?php
/**
 * 为中文标题的HTML生成nginx短链rewrite规则配置，精简wiki的URL长度
 *
 * Usage:
 *
 * # php ./generate_nginx_rewrite.php > /usr/local/nginx/conf/vhost/rewirte_wikis
 * # /usr/local/nginx/sbin/nginx -t
 * # /usr/local/nginx/sbin/nginx -s reload
 *
 * @author dogstar 20170602
 */

$wikisPath = dirname(__FILE__) . '/../wikis';
$allFiles = scandir($wikisPath);
//var_dump($allFiles);

echo "\n";

foreach ($allFiles as $file) {
    preg_match("/\[(.*)\]\-/", $file, $matches);

    if (empty($matches)) {
        continue;
    }

    $longUrl = '/wikis/' . $file;
    $shortUrl = '/wikis/' . str_replace('.', '-', $matches[1]) . '.html';

    echo "  rewrite '$shortUrl' '$longUrl';\n";
}

echo "\n";

