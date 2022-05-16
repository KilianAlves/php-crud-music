<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Album;
use Entity\Artist;
use PDO;

class AlbumCollection
{
    public static function findByArtistId(int $artistId): ?array
    {

        #recupere album
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id, name, year, artistId, genreId, coverId
            FROM album
            WHERE artistId = ?
            ORDER BY year DESC, name
            SQL
        );
        $stmt->execute([$artistId]);

        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Album::class);

        return $stmt->fetchAll();
    }
}
