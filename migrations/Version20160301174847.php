<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160301174847 extends AbstractMigration
{
    public static $description = "alter field id to table user_plans";
    public static $author = "Deybee Chavez";

    public function up(MetadataInterface $schema)
    {
        $this->addSql("SET FOREIGN_KEY_CHECKS=0");
        $this->addSql("ALTER TABLE user_plans CHANGE COLUMN id id INT(11) NOT NULL AUTO_INCREMENT");
        $this->addSql("SET FOREIGN_KEY_CHECKS=1");

    }

    public function down(MetadataInterface $schema)
    {
        //throw new \RuntimeException('No way to go down!');
        //$this->addSql(/*Sql instruction*/);
    }
}
