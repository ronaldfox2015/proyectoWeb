<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160314014002 extends AbstractMigration
{
    public static $description = "Agregando campo code al metodo de pago";

    public function up(MetadataInterface $schema)
    {
        $this->addSql('ALTER TABLE payment_methods ADD code varchar(20) NULL');
    }

    public function down(MetadataInterface $schema)
    {
        //throw new \RuntimeException('No way to go down!');
        //$this->addSql(/*Sql instruction*/);
    }
}
