<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160321190517 extends AbstractMigration
{
    public static $description = "Migration description";

    public function up(MetadataInterface $schema)
    {
        $this->addSql(" billing_receipt_type

                ALTER TABLE users     ADD COLUMN fullname VARCHAR(200) NULL ;
                ALTER TABLE user_plans     ADD COLUMN individual CHAR(2) NULL ;
                ALTER TABLE user_plans     ADD COLUMN contact VARCHAR(200) NULL ;
                ALTER TABLE user_plans     ADD COLUMN billing_receipt_type CHAR(2) NULL ;
                ");
    }

    public function down(MetadataInterface $schema)
    {
        //throw new \RuntimeException('No way to go down!');
        //$this->addSql(/*Sql instruction*/);
    }
}
