<?php

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use PDO;

class Cover
{
    private int $id;
    private string $jpeg;

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
    public function getJpeg(): string
    {
        return $this->jpeg;
    }

    public static function findById($id): Cover
    {
        $stml = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id,jpeg
            FROM cover
            WHERE id = ? 
            SQL
        );

        #execute le sql
        $stml->execute([$id]);
        $stml->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Cover::class);

        $cover = $stml->fetch();
        if ($cover === false) {
            throw new EntityNotFoundException("Cover with id $id not found");
        }
        return $cover;
    }
}
