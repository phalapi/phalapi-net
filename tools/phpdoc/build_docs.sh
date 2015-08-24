#!/bin/bash

## Env
#WIKI_PATH=$1
PHALAPI_PATH="/mnt/hgfs/F/PHP/PhalApi"
PHALAPI_NET_PATH="/mnt/hgfs/F/PHP/PhalApi-Net"
BASE_PATH="/mnt/hgfs/F/PHP/PhalApi-Net/tools/phpdoc"
PHPDOC_PATH="/usr/bin/phpdoc"

cd $BASE_PATH;

$PHPDOC_PATH  --config=./phpdoc.xml 

cp ./imgs/* ./_phalapi_docs_release/images/;

rm $PHALAPI_PATH/docs/* -rf;
cp ./_phalapi_docs_release/* $PHALAPI_PATH/docs/ -R;

rm $PHALAPI_NET_PATH/docs/* -rf;
cp ./_phalapi_docs_release/* $PHALAPI_NET_PATH/docs/ -R;

echo ""
echo "done!"
echo ""

