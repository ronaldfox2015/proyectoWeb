<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160301162128 extends AbstractMigration
{
    public static $description = "Modificando table para agregar auto increment";
    public static $author = "Deybee Chavez";

    public function up(MetadataInterface $schema)
    {
        $this->addSql("ALTER TABLE transactions CHANGE COLUMN id id INT(11) NOT NULL AUTO_INCREMENT");
    }

    public function down(MetadataInterface $schema)
    {
        //throw new \RuntimeException('No way to go down!');
        //$this->addSql(/*Sql instruction*/);
    }
}
