<?php

declare(strict_types=1);

use Entity\Artist;
use Entity\Collection\AlbumCollection;
use Entity\Exception\EntityNotFoundException;
use Html\AppWebPage;
use Html\WebPage;

#require_once '../vendor/autoload.php';


if (!isset($_GET["artistId"]) || !ctype_digit($_GET["artistId"])) {
    header('Location: /');
    exit();
}



$artistId = $_GET["artistId"];

$artistId = intval($artistId);

try {
    $searchArtist = Artist::findById($artistId);
} catch (EntityNotFoundException $e) {
    http_response_code(404);
    exit();
}


$artist = Artist::findById($artistId);

$AlbumNameYear = AlbumCollection::findByArtistId($artistId);

$webPage = new AppWebPage(); #crée page web avec titre en nom
$name = WebPage::escapeString("{$artist->getName()}");
$webPage->setTitle("Albums de $name");

$webPage->appendContent("<div class='list'>"); #div

#avoir année et nom album
foreach ($AlbumNameYear as $album) {
    $yearAlbum = WebPage::escapeString("{$album->getYear()}");
    $nameAlbum = WebPage::escapeString("{$album->getName()}");
    $webPage->appendContent("<div class='album'>");
    $webPage->appendContent("<div class='album__year'>");
    $webPage->appendContent("<p>$yearAlbum");
    $webPage->appendContent("</div>\n");
    $webPage->appendContent("<div class='album__name'>");
    $webPage->appendContent("<p>$nameAlbum");
    $webPage->appendContent("</div>\n");
    $webPage->appendContent("</div>");
}

$webPage->appendContent("</div>"); #fin div

$webPage->appendToHead($head = '<!DOCTYPE html><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0"></head>');
echo $webPage->toHTML();
