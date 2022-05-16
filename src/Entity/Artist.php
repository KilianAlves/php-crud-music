<?php

namespace Entity;

use Database\MyPdo;
use Entity\Collection\AlbumCollection;
use PDO;

class Artist
{
    private int $id;
    private string $name;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public static function findById(int $id)
    {
        $AlbumEtDate = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id, name
            FROM artist
            WHERE id = ? 
            ORDER BY year DESC
            SQL
        );

        #execute le sql
        $AlbumEtDate->execute([$id]);
        $AlbumEtDate->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Artist::class);
        return $AlbumEtDate->fetch();
    }

    public function getAlbums()
    {
        $albums = AlbumCollection::findByArtistId($this->getId());
        return $albums;
    }
}
