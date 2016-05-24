<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160316002113 extends AbstractMigration
{
    public static $description = "Alterando la cantidad de caracteres de la bd";  

    public function up(MetadataInterface $schema)
    {
        $this->addSql("ALTER TABLE user_plans MODIFY COLUMN document_number varchar(20) NULL;");
    }

    public function down(MetadataInterface $schema)
    {
        //throw new \RuntimeException('No way to go down!');
        //$this->addSql(/*Sql instruction*/);
    }
}
