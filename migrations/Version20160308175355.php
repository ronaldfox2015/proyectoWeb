<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160308175355 extends AbstractMigration
{
    public static $description = "Insertando Metodos de pago";

    public function up(MetadataInterface $schema)
    {
        $this->addSql("insert into payment_methods(name) values('Visa'),
('MasterCard'),
('American Express'),
('Diners')");
    }

    public function down(MetadataInterface $schema)
    {
        //throw new \RuntimeException('No way to go down!');
        //$this->addSql(/*Sql instruction*/);
    }
}
