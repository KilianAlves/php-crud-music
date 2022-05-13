<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Artist;
use PDO;

class ArtistCollection
{
    /**
     * La methode cree un tableau avec tout les artistes & id
     *
     * @return Artist[]
     */
    public static function findAll(): array
    {

        #recupere les nom des artistes
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id, name
            FROM artist
            ORDER BY name
            SQL
        );
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Artist::class);

        return $stmt->fetchAll();
    }
}
