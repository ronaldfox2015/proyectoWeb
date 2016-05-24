<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160301190744 extends AbstractMigration
{
    public static $description = "Agregando campo enable";

    public function up(MetadataInterface $schema)
    {
        $this->addSql("ALTER TABLE user_plans ADD COLUMN enable TINYINT NOT NULL DEFAULT 0 AFTER vehicles_available");
    }

    public function down(MetadataInterface $schema)
    {
        //throw new \RuntimeException('No way to go down!');
        //$this->addSql(/*Sql instruction*/);
    }
}
