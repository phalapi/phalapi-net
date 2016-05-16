#!/bin/bash
#
# @author dogstar 20160517

basepath=$(cd `dirname $0`; pwd)
cd $basepath
pwd

NEED_UPDATE="1"

cat _update.log | while read line
do

    if [ "$line" == "$NEED_UPDATE" ]; then
        git pull

        echo "0" > _update.log

        exit 0
    fi

done
