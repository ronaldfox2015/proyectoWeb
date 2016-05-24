<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160309150603 extends AbstractMigration
{
    public static $description = "Incrementando el numero de transacciones realizadas";

    public function up(MetadataInterface $schema)
    {
        $this->addSql("alter table transactions AUTO_INCREMENT=18000");
    }

    public function down(MetadataInterface $schema)
    {
        //throw new \RuntimeException('No way to go down!');
        //$this->addSql(/*Sql instruction*/);
    }
}
