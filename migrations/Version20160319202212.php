<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160319202212 extends AbstractMigration
{
    public static $description = "Eliminar columna is_not_robot";

    public function up(MetadataInterface $schema)
    {
        $this->addSql("
            ALTER TABLE `claims` DROP COLUMN `is_not_robot`;
        ");
    }

    public function down(MetadataInterface $schema)
    {
        //throw new \RuntimeException('No way to go down!');
        //$this->addSql(/*Sql instruction*/);
    }
}
