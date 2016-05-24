<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160328210312 extends AbstractMigration
{
    public static $description = "Migration description";

    public function up(MetadataInterface $schema)
    {
        $this->addSql("
                    CREATE TABLE `import` (
                    `id` INT(11) NOT NULL AUTO_INCREMENT,
                    `type` CHAR(4) NOT NULL,
                    `version` VARCHAR(20) NOT NULL,
                    PRIMARY KEY (`id`)
                    ) ENGINE=MYISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
                ");
    }

    public function down(MetadataInterface $schema)
    {
        //throw new \RuntimeException('No way to go down!');
        //$this->addSql(/*Sql instruction*/);
    }
}
