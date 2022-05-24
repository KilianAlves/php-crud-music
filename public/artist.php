<?php

declare(strict_types=1);

use Entity\Artist;
use Entity\Collection\AlbumCollection;
use Html\AppWebPage;
use Html\WebPage;

#require_once '../vendor/autoload.php';


if (!isset($_GET["artistId"]) && !is_int($_GET["artistId"])) {
    header('Location: /');
    exit;
}

$artistId = $_GET["artistId"];

$artistId = intval($artistId);

$artist = Artist::findById($artistId);
$AlbumNameYear = AlbumCollection::findByArtistId($artistId);

$webPage = new AppWebPage($artist->getName()); #crée page web avec titre en nom

$webPage->appendContent("<div class='list'>"); #div

#avoir année et nom album
foreach ($AlbumNameYear as $album) {
    $yearAlbum = WebPage::escapeString("{$album->getYear()}");
    $nameAlbum = WebPage::escapeString("{$album->getName()}");
    $webPage->appendContent("<div class='album'>");
    $webPage->appendContent("<div class='album__year'>");
    $webPage->appendContent("<p>$yearAlbum\n");
    $webPage->appendContent("</div>");
    $webPage->appendContent("<div class='album__name'>");
    $webPage->appendContent("<p>$nameAlbum\n");
    $webPage->appendContent("</div>");
    $webPage->appendContent("</div>");
}

$webPage->appendContent("</div>"); #fin div

$webPage->appendToHead($head = '<!DOCTYPE html><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0"></head>');
echo $webPage->toHTML();
