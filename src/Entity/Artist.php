<?php

namespace Entity;

use Database\MyPdo;
use Entity\Collection\AlbumCollection;
use Entity\Exception\EntityNotFoundException;
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

    public static function findById(int $id): Artist
    {
        $AlbumEtDate = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id, name
            FROM artist
            WHERE id = ? 
            SQL
        );

        #execute le sql
        $AlbumEtDate->execute([$id]);
        $AlbumEtDate->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Artist::class);
        $artist = $AlbumEtDate->fetch();

        if ($artist === false) {
            throw new EntityNotFoundException("Artist with id $id not found");
        }
        return $artist;
    }

    public function getAlbums(): ?array
    {
        return AlbumCollection::findByArtistId($this->getId());
    }
}
