<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160418174647 extends AbstractMigration
{
    public static $description = "Agregando campo url fail";

    public function up(MetadataInterface $schema)
    {
        $this->addSql("ALTER TABLE transactions ADD urlFail varchar(200) DEFAULT '/registro-individual' NULL;");
    }

    public function down(MetadataInterface $schema)
    {
        //throw new \RuntimeException('No way to go down!');
        //$this->addSql(/*Sql instruction*/);
    }
}
