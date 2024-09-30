<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%attachment_permohonan}}`.
 */
class m200809_083444_create_attachment_permohonan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%epbb.attachment_permohonan}}', [
            'id' => $this->primaryKey(),
            'thn_pelayanan' => $this->char(4)->notNull(),
            'bundel_pelayanan' => $this->char(4)->notNull(),
            'no_urut_pelayanan' => $this->char(3)->notNull(),
            'jenis_lampiran' => $this->string()->notNull(),
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
        $this->dropTable('{{%epbb.attachment_permohonan}}');
    }
}
