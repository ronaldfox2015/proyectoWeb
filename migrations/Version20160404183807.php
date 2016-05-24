<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160404183807 extends AbstractMigration
{
    public static $description = "Migration description";

    public function up(MetadataInterface $schema)
    {
        $this->addSql("ALTER TABLE `transito` 
            ADD COLUMN `id` INT NOT NULL AUTO_INCREMENT ,
            ADD COLUMN `dateAdd` DATETIME NULL DEFAULT now() ,
            ADD PRIMARY KEY (`id`);");
    }

    public function down(MetadataInterface $schema)
    {
        //throw new \RuntimeException('No way to go down!');
        //$this->addSql(/*Sql instruction*/);
    }
}
