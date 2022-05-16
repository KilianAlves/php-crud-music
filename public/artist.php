<?php

declare(strict_types=1);

use Database\MyPdo;
use Html\WebPage;

#require_once '../vendor/autoload.php';


if (!isset($_GET["artistId"]) && !is_int($_GET["artistId"])) {
    header('Location: /');
    exit;
}

$artistId = $_GET["artistId"];

$webPage = new WebPage();

#Requête sql

#avoir le nom artiste
$name = MyPDO::getInstance()->prepare(
    <<<'SQL'
    SELECT name
    FROM artist
    WHERE id = ?
SQL
);

#avoir année et nom album
$AlbumEtDate = MyPDO::getInstance()->prepare(
    <<<'SQL'
    SELECT year ,name
    FROM album
    WHERE artistId = ? 
    ORDER BY year DESC
SQL
);

#execute le sql
$name->execute([$artistId]);
$AlbumEtDate->execute([$artistId]);



#avoir le nom artiste
while (($ligne = $name->fetch()) !== false) {
    $string = WebPage::escapeString("{$ligne['name']}");
    $webPage->appendContent("<h1>Albums de $string</h1>");
    $webPage->setTitle("Albums de $string");
}

#avoir année et nom album
while (($ligne = $AlbumEtDate->fetch()) !== false) {
    $yearAlbum = WebPage::escapeString("{$ligne['year']}");
    $nameAlbum = WebPage::escapeString("{$ligne['name']}");
    $webPage->appendContent("<p>$yearAlbum $nameAlbum\n");
}






$webPage->appendToHead($head = '<!DOCTYPE html><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0"></head>');








echo $webPage->toHTML();
