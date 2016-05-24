<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160311210136 extends AbstractMigration
{
    public static $description = "Migration description";

    public function up(MetadataInterface $schema)
    {       
        $this->addSql("CREATE TABLE contactanos (               
                id INT(11) NOT NULL AUTO_INCREMENT,               
                name VARCHAR(45) NOT NULL,
                lastname VARCHAR(45) NOT NULL,
                subject VARCHAR(200) NOT NULL,
                message VARCHAR(500) NOT NULL,
                telefono1 VARCHAR(100) NOT NULL,
                telefono2 VARCHAR(100) NOT NULL,
                email VARCHAR(150) NOT NULL,
                created_at TIMESTAMP NOT NULL DEFAULT now(),
                updated_at TIMESTAMP NOT NULL DEFAULT now(),
                PRIMARY KEY (id)
            )ENGINE = INNODB;");
    }

    public function down(MetadataInterface $schema)
    {
        //throw new \RuntimeException('No way to go down!');
        //$this->addSql(/*Sql instruction*/);
    }
}
