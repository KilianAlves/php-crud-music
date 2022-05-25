<?php

declare(strict_types=1);

use Entity\Collection\ArtistCollection;
use Html\AppWebPage;

#require_once '../vendor/autoload.php';

$webPage = new AppWebPage("Artistes");

#$webPage->appendToHead($head = '<!DOCTYPE html><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Document</title></head>');

$webPage->appendContent("<div class='list'>");
foreach (ArtistCollection::findAll() as $artist) {
    $textname = $webPage::escapeString($artist->getName());
    $webPage->appendContent("<p> <a href='artist.php?artistId={$artist->getId()}'>$textname</a></p>\n");
}
$webPage->appendContent("</div>");
echo $webPage->toHTML();
