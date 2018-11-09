<?php

use yii\db\Migration;

/**
 * Handles the creation of table `system`.
 */
class m181109_202353_create_system_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%ds_system}}', [
            'id' => $this->primaryKey(),
            'show_prices' => $this->smallInteger()->notNull()->defaultValue(1),
        ]);

        $this->insert('{{%ds_system}}', [
            'show_prices' => 1,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%ds_system}}');
    }
}
