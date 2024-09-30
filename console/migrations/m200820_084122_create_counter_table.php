<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%counter}}`.
 */
class m200820_084122_create_counter_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%epbb.counter}}', [
            'id' => $this->primaryKey(),
            'counter' => $this->integer(),
            'updatedtime' => $this->timestamp(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%epbb.counter}}');
    }
}
