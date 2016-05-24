<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160312181004 extends AbstractMigration
{
    public static $description = "Migration description";

    public function up(MetadataInterface $schema)
    {
        $this->addSql(" ALTER TABLE users ADD COLUMN recover_expiration TIMESTAMP;
                        ALTER TABLE users ADD COLUMN recover_token VARCHAR(120);
                        ALTER TABLE users ADD COLUMN recover_selector VARCHAR(120);
                        ALTER TABLE users ADD COLUMN email_check_token VARCHAR(120);
        ");
    }

    public function down(MetadataInterface $schema)
    {
        //throw new \RuntimeException('No way to go down!');
        //$this->addSql(/*Sql instruction*/);
    }
}
