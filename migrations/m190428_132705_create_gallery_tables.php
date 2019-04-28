<?php

use yii\db\Migration;

/**
 * Class m190428_132705_create_gallery_tables
 */
class m190428_132705_create_gallery_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ds_gallery}}', [
            'id' => $this->primaryKey(),
            'type' => $this->integer()->notNull()->defaultValue(1),
            'file' => $this->string()->notNull(),

            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->null(),
            'updated_at' => $this->integer()->null(),
        ], $tableOptions);

        $this->batchInsert('{{%ds_gallery}}', ['type', 'file'], [
            [1, '1.jpg'],
            [1, '2.jpg'],
            [1, '3.jpg'],
            [1, '4.jpg'],
            [1, '5.jpg'],
            [1, '6.jpg'],
            [1, '7.jpg'],
            [1, '8.jpg'],
            [1, '9.jpg'],
            [1, '10.jpg'],
            [1, '11.jpg'],
            [1, '12.jpg'],
            [1, '13.jpg'],
            [1, '14.jpg'],
            [1, '15.jpg'],
            [1, '16.jpg'],
            [1, '17.jpg'],
            [1, '18.jpg'],
            [1, '19.jpg'],
            [1, '20.jpg'],
            [1, '21.jpg'],
            [1, '22.jpg'],
            [2, '1.jpg'],
            [2, '2.jpg'],
            [2, '3.jpg'],
            [2, '4.jpg'],
            [2, '5.jpg'],
            [2, '6.jpg'],
            [2, '7.jpg'],
            [2, '8.jpg'],
            [2, '9.jpg'],
            [2, '10.jpg'],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%ds_gallery}}');
    }

}
