<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160309112152 extends AbstractMigration
{

    public static $description = "Ronald Cutisaca";

    public function up(MetadataInterface $schema)
    {
        $this->addSql("
             ALTER TABLE user_plans CHANGE document_type_id document_type_id CHAR(2) NULL;
        ");

    }

    public function down(MetadataInterface $schema)
    {
        //throw new \RuntimeException('No way to go down!');
        //$this->addSql(/*Sql instruction*/);

    }

}
