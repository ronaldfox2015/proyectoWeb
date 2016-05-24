<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160314163315 extends AbstractMigration
{
    public static $description = "Agregar compos de creacion y actualizacion a tabla claims";

    public function up(MetadataInterface $schema)
    {
        $this->addSql("
            ALTER TABLE `claims`
            ADD COLUMN `created_at` TIMESTAMP NOT NULL DEFAULT now() AFTER `is_not_robot`,
            ADD COLUMN `updated_at` TIMESTAMP NOT NULL DEFAULT now() AFTER `created_at`;

        ");
    }

    public function down(MetadataInterface $schema)
    {
        //throw new \RuntimeException('No way to go down!');
        //$this->addSql(/*Sql instruction*/);
    }
}
