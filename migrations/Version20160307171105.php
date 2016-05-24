<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160307171105 extends AbstractMigration
{
    public static $description = "alter ePass.vehicles";
    public static $author = "Renzo Tejada";

    public function up(MetadataInterface $schema)
    {
        $this->addSql("
            ALTER TABLE vehicles MODIFY type varchar(2) NOT NULL;
        ");
    }

    public function down(MetadataInterface $schema)
    {
        //throw new \RuntimeException('No way to go down!');
        //$this->addSql(/*Sql instruction*/);
    }
}
