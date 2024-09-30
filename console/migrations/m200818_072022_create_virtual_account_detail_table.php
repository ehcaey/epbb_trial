<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%virtual_account_detail}}`.
 */
class m200818_072022_create_virtual_account_detail_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%epbb.virtual_account_detail}}', [
            'id' => $this->primaryKey(),
            'no_va' => $this->string(20)->notNull(),
            'tahun_pajak' => $this->char(4)->notNull(),
            'jumlah_pajak' => $this->double()->defaultValue(0), 
            'denda_pajak' => $this->double()->defaultValue(0),
            'biaya_admin' => $this->double()->defaultValue(0),
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
        $this->dropTable('{{%epbb.virtual_account_detail}}');
    }
}
