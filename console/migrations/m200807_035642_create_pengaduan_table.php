<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pengaduan}}`.
 */
class m200807_035642_create_pengaduan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%epbb.aduan}}', [
            'id' => $this->primaryKey(),
            'subjek' => $this->string()->notNull(),
            'status' => $this->string(1)->notNull(),
            'createdby' => $this->integer(),
            'createdtime' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updatedby' => $this->integer(),
            'updatedtime' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->createTable('{{%epbb.balasan_aduan}}', [
            'id' => $this->primaryKey(),
            'id_aduan' => $this->integer()->notNull(),
            'tipe_user' => $this->string(1)->notNull(),
            'isi' => $this->string()->notNull(),
            'createdby' => $this->integer(),
            'createdtime' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updatedby' => $this->integer(),
            'updatedtime' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->createTable('{{%epbb.attachment_aduan}}', [
            'id' => $this->primaryKey(),
            'id_balasan' => $this->integer()->notNull(),
            'file_path' => $this->string()->notNull(),
            'file_name' => $this->string()->notNull(),
            'createdby' => $this->integer(),
            'createdtime' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updatedby' => $this->integer(),
            'updatedtime' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%epbb.aduan}}');
        $this->dropTable('{{%epbb.balasan_aduan}}');
        $this->dropTable('{{%epbb.attachment_aduan}}');
    }
}
