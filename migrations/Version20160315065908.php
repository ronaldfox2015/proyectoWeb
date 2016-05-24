<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160315065908 extends AbstractMigration
{

    public static $description = "Migration description";

    public function up(MetadataInterface $schema)
    {
        $this->addSql('
            ALTER TABLE transactions     ADD COLUMN document_number CHAR(12) NULL AFTER updated_at;
ALTER TABLE transactions     ADD COLUMN tipo_doc CHAR(8) NULL AFTER updated_at;
ALTER TABLE transactions     ADD COLUMN razon_social VARCHAR(200) NULL AFTER updated_at;
');

    }

    public function down(MetadataInterface $schema)
    {
        //throw new \RuntimeException('No way to go down!');
        //$this->addSql(/*Sql instruction*/);

    }

}
