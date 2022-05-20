<?php

declare(strict_types=1);

use Database\MyPdo;
use Entity\Artist;
use Entity\Collection\AlbumCollection;
use Html\WebPage;

#require_once '../vendor/autoload.php';


if (!isset($_GET["artistId"]) && !is_int($_GET["artistId"])) {
    header('Location: /');
    exit;
}

$artistId = $_GET["artistId"];

$webPage = new WebPage();


$artistId = intval($artistId);



$artist = Artist::findById($artistId);
$AlbumNameYear = AlbumCollection::findByArtistId($artistId);


#avoir le nom artiste
    $string = WebPage::escapeString("{$artist->getName()}");
    $webPage->appendContent("<h1>Albums de $string</h1>");
    #$webPage->setTitle("Albums de $string");

#avoir année et nom album
foreach ($AlbumNameYear as $album) {
    $yearAlbum = WebPage::escapeString("{$album->getYear()}");
    $nameAlbum = WebPage::escapeString("{$album->getName()}");
    $webPage->appendContent("<p>$yearAlbum $nameAlbum\n");
}









$webPage->appendToHead($head = '<!DOCTYPE html><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0"></head>');

echo $webPage->toHTML();
