#!/bin/bash
#
# ./build_pdf.sh
#
# @author dogstar 20151107
#

## Usage

## Env
#WIKI_PATH=$1
WIKI_PATH="/mnt/hgfs/F/PHP/PhalApi.wiki"
BASE_PATH=$(cd `dirname $0`; pwd)
BASE_PATH="/mnt/hgfs/F/PHP/PhalApi-Net/tools/"
PHP_PATH="/usr/bin/php"

if [ ! -d $WIKI_PATH ]
then
    echo "Error: can not open $WIKI_PATH !"
    echo ""
    exit 2
fi

ALL_IN_ONE="/tmp/PhalApi-Wikis.md"
echo "" > $ALL_IN_ONE

while read line
do
    if [ ! -f $WIKI_PATH/$line ]; then
        echo "no such file: $line"
        continue;
    fi

    echo "add $line ..."

    echo "#"${line/.md/} >> $ALL_IN_ONE

    cat $WIKI_PATH/$line >> $ALL_IN_ONE
done < $BASE_PATH/pdf_config.txt

$PHP_PATH $BASE_PATH/parse_markdown_file.php $ALL_IN_ONE $BASE_PATH/../wikis

echo "done!"

