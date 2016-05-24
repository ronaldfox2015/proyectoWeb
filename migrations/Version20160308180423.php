<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160308180423 extends AbstractMigration
{
    public static $description = "Ingresando tipos de transacciones";

    public function up(MetadataInterface $schema)
    {
        $this->addSql("insert into transaction_types(name) values('Afiliacion + Recarga'),('Recarga')");
    }

    public function down(MetadataInterface $schema)
    {
        //throw new \RuntimeException('No way to go down!');
        //$this->addSql(/*Sql instruction*/);
    }
}
