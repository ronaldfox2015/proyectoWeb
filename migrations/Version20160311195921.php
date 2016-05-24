<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160311195921 extends AbstractMigration
{
    public static $description = "Agregando columna al table user_plans";
    public static $author = "Renzo Tejada";

    public function up(MetadataInterface $schema)
    {
        $this->addSql("
            ALTER TABLE user_plans ADD column razon_social VARCHAR(200) NOT NULL after document_number;
            ALTER TABLE user_plans DROP ruc;
        ");
    }

    public function down(MetadataInterface $schema)
    {
        //throw new \RuntimeException('No way to go down!');
        //$this->addSql(/*Sql instruction*/);
    }
}
