<?php
$value = $_GET;
$options = array('-d', '/usr/local/lib/mecab/dic/ipadic');
$mecab = new MeCab\Tagger($options);
$nodes = $mecab->parseToNode($value['str']);

$i = 1;
$arrayResult = array();

foreach ($nodes as $n)
{
    $arrayResult[$i][] = $n->getSurface();
    $arrayResult[$i][] = $n->getFeature();
    $i++;
}

array_shift($arrayResult);
array_pop($arrayResult);

echo(json_encode($arrayResult));
