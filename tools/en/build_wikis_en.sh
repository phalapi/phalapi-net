#!/bin/bash
#
# ./build_wikis_en.sh /mnt/hgfs/F/github/PhalApi-Wikis/en/
#
# @author dogstar 20160110
#

## Usage
if [ $# -lt 1 ] 
then
    echo "Usage: $0 <PhalApi-Wikis-en>"
    echo ""
    #exit 1
fi

## Env
#WIKI_PATH=$1
WIKI_PATH="/mnt/hgfs/F/github/PhalApi-Wikis/en/"
BASE_PATH=$(cd `dirname $0`; pwd)
BASE_PATH="/mnt/hgfs/F/PHP/PhalApi-Net/tools/en/"
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
    $PHP_PATH $BASE_PATH/parse_markdown_file.php $WIKI_PATH/$line $BASE_PATH/../../wikis/en
done

echo ""
echo "OK!"
echo ""

