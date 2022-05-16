<?php

declare(strict_types=1);

use Database\MyPdo;
use Html\WebPage;
use Entity\Artist;
use Entity\Collection\ArtistCollection;

#require_once '../vendor/autoload.php';

$webPage = new WebPage();



#MyPDO::setConfiguration('mysql:host=mysql;dbname=cutron01_music;charset=utf8', 'web', 'web');
#$stmt = MyPDO::getInstance()->prepare(
#    <<<'SQL'
#    SELECT id, name
#    FROM artist
#    ORDER BY name
#SQL
#);

$webPage->appendToHead($head = '<!DOCTYPE html><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Document</title></head>');

#$stmt->execute();

#while (($ligne = $stmt->fetch()) !== false) {
#    $string = WebPage::escapeString("{$ligne['name']}");
#    $webPage->appendContent("<p> <a href='artist.php?artistId={$ligne['id']}'>$string</a></p>");
#}

$artists = ArtistCollection::findAll();

foreach ($artists as $artist) {
    $webPage->appendContent("<p> <a href='artist.php?artistId={$artist->getId()}'>{$artist->getName()}</a></p>\n");
}


echo $webPage->toHTML();
