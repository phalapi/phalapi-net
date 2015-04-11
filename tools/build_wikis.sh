#!/bin/bash
#
# ./build_wikis.sh /mnt/hgfs/F/PHP/PhalApi.wiki/
#
# @author dogstar 20150408
#

## Usage
if [ $# -lt 1 ] 
then
    echo "Usage: $0 <PhalApi.wiki>"
    echo ""
    #exit 1
fi

## Env
#WIKI_PATH=$1
WIKI_PATH="/mnt/hgfs/F/PHP/PhalApi.wiki"
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
    $PHP_PATH $BASE_PATH/parse_markdown_file.php $WIKI_PATH/$line $BASE_PATH/../wikis
done

echo ""
echo "OK!"
echo ""

