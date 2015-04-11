#!/bin/bash
#
# @author dogstar 20150408
#

## Env
WIKI_PATH="./html"
BASE_PATH=$(cd `dirname $0`; pwd)
PHP_PATH="/usr/bin/php"

if [ ! -d $WIKI_PATH ]
then
    echo "Error: can not open $WIKI_PATH !"
    echo ""
    exit 2
fi

for line in $(ls $WIKI_PATH)
do
    echo "build $line ..."
    $PHP_PATH $BASE_PATH/parse_html_file.php $WIKI_PATH/$line $BASE_PATH/../
done

echo ""
echo "OK!"
echo ""

