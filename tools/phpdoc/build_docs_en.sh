#!/bin/bash

## Env
#WIKI_PATH=$1
PHALAPI_PATH="/mnt/hgfs/F/PHP/PhalApi"
PHALAPI_NET_PATH="/mnt/hgfs/F/PHP/PhalApi-Net"
BASE_PATH="/mnt/hgfs/F/PHP/PhalApi-Net/tools/phpdoc"
PHPDOC_PATH="/usr/bin/phpdoc"

cd $BASE_PATH;

#清除旧的生成
rm ./_phalapi_docs_release_en/* -rf;

$PHPDOC_PATH --ignore "*/Tests/*,/mnt/hgfs/F/PHP/PhalApi/PhalApi/Tests/*" --config=./phpdoc_en.xml 

cp ./imgs/* ./_phalapi_docs_release_en/images/;

#框架已不再需要文档
#rm $PHALAPI_PATH/docs/* -rf;
#cp ./_phalapi_docs_release/* $PHALAPI_PATH/docs/ -R;

rm $PHALAPI_NET_PATH/docs_en/* -rf;
cp ./_phalapi_docs_release_en/* $PHALAPI_NET_PATH/docs_en/ -R;

echo ""
echo "english done!"
echo ""

