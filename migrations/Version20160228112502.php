<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160228112502 extends AbstractMigration
{
    public static $description = "Table ePass.vehicles";
    public static $author = "Renzo Tejada";

    public function up(MetadataInterface $schema)
    {
        $this->addSql("
            CREATE TABLE IF NOT EXISTS `vehicles` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `license_plate` CHAR(10) NOT NULL,
                `color` VARCHAR(15) NOT NULL,
                `type` CHAR(1) NOT NULL,
                `brand` VARCHAR(80) NOT NULL,
                `model` VARCHAR(80) NOT NULL,
                `tag` VARCHAR(100) NULL,
                `created_at` TIMESTAMP NOT NULL DEFAULT now(),
                `updated_at` TIMESTAMP NOT NULL DEFAULT now(),
                `migrate` TINYINT NOT NULL DEFAULT 0,
                PRIMARY KEY (`id`))
              ENGINE = InnoDB
              DEFAULT CHARACTER SET = utf8;
                ");
    }

    public function down(MetadataInterface $schema)
    {
        //throw new \RuntimeException('No way to go down!');
        //$this->addSql(/*Sql instruction*/);
    }
}
