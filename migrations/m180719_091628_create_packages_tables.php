<?php

use yii\db\Migration;

/**
 * Class m180719_091628_create_packages_tables
 */
class m180719_091628_create_packages_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ds_packages_types}}', [
          'id' => $this->primaryKey(),
          'name' => $this->string()->notNull(),

          'status'     => $this->smallInteger()->notNull()->defaultValue(1),
          'created_at' => $this->integer()->null(),
          'updated_at' => $this->integer()->null(),
        ], $tableOptions);

        $this->createTable('{{%ds_packages}}', [
            'id' => $this->primaryKey(),
            'type_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'price' => $this->double()->notNull(),
            'image' => $this->string()->null(),

            'status'     => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->null(),
            'updated_at' => $this->integer()->null(),
        ], $tableOptions);

        $this->batchInsert('{{%ds_packages_types}}', ['name'], [
            ['Porción Individual'],
            ['Envase'],
            ['Postre Completo Kg'],
            ['Shots'],
            ['Vasito de 5oz'],
            ['Vasito de 8oz'],
            ['Bombones'],
        ]);

        $this->batchInsert('{{%ds_packages}}', ['type_id', 'name', 'price'], [
            [1, 'Envase Individual', 1],
            [2, 'Envase', 1],
            [3, 'Caja Grande', 1],
            [4, 'Cajita de 3', 1],
            [4, 'Cajita de 12', 1],
            [5, 'Envase de 5oz', 1],
            [6, 'Envase de 8oz', 1],
            [7, 'Cajita de 3', 1],
            [7, 'Cajita de 12', 1],
        ]);

        $this->createIndex('idx-ds_packages-type_id', 'ds_packages', 'type_id');
        $this->addForeignKey('fk-ds_packages-ds_packages_types', 'ds_packages', 'type_id', 'ds_packages_types', 'id');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-ds_packages-ds_packages_types', 'ds_packages');
        $this->dropIndex('idx-ds_packages-type_id', 'ds_packages');

        $this->dropTable('{{%ds_packages}}');
        $this->dropTable('{{%ds_packages_types}}');
    }
}
