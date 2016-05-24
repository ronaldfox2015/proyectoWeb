<?php

namespace ZfSimpleMigrations\Migrations;

use ZfSimpleMigrations\Library\AbstractMigration;
use Zend\Db\Metadata\MetadataInterface;

class Version20160302093858 extends AbstractMigration
{
    public static $description = "generacion de la tabla promociones";
    public static $author = "Deybee Chavez";

    public function up(MetadataInterface $schema)
    {
        $this->addSql("CREATE TABLE promotions (
          id INT NOT NULL AUTO_INCREMENT,
          promotion_code INT NOT NULL,
          user_plan_id INT NOT NULL,
          created_up TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
          updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
          migration TINYINT NOT NULL DEFAULT 0,
          PRIMARY KEY (id),
          INDEX fk_promotions_user_plan_idx (user_plan_id ASC),
          CONSTRAINT fk_promotions_user_plan
          FOREIGN KEY (user_plan_id)
          REFERENCES user_plans (id)
          ON DELETE NO ACTION
          ON UPDATE NO ACTION)");
    }

    public function down(MetadataInterface $schema)
    {
        //throw new \RuntimeException('No way to go down!');
        //$this->addSql(/*Sql instruction*/);
    }
}
