<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160304115301 extends AbstractMigration
{
    public static $description = "Table ePass.adocumenttype";
    public static $author = "Antonio Espinoza";

    public function up(MetadataInterface $schema)
    {
        $this->addSql("
CREATE TABLE adocumenttype (
	TYPE VARCHAR(2) NOT NULL,
	DESCRIPTION VARCHAR(30) NOT NULL,
	LENGTH INT DEFAULT NULL,
	FORMAT VARCHAR(1) DEFAULT NULL,
	PRIMARY KEY (TYPE)
)ENGINE = INNODB;
INSERT INTO adocumenttype VALUES ('00','RUC',11,'N');
INSERT INTO adocumenttype VALUES ('01','DNI',8,'N');
INSERT INTO adocumenttype VALUES ('02','CE',9,'N');
INSERT INTO adocumenttype VALUES ('03','PASAPORTE',NULL,'A');                ");
    }

    public function down(MetadataInterface $schema)
    {
        //throw new \RuntimeException('No way to go down!');
        //$this->addSql(/*Sql instruction*/);
    }
}
