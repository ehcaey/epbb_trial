<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%virtual_account}}`.
 */
class m200818_072011_create_virtual_account_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%epbb.virtual_account}}', [
            'id' => $this->primaryKey(),
            'no_va' => $this->string(20)->notNull(),
            'kd_propinsi' => $this->char(2)->notNull(),
            'kd_dati2' => $this->char(2)->notNull(),
            'kd_kecamatan' => $this->char(3)->notNull(),
            'kd_kelurahan' => $this->char(3)->notNull(),
            'kd_blok' => $this->char(3)->notNull(),
            'no_urut' => $this->char(4)->notNull(),
            'kd_jns_op' => $this->char(1)->notNull(),
            'alamat_op' => $this->string()->null(),
            'kota_op' => $this->string(50)->null(),
            'no_arsip' => $this->integer()->defaultValue(0),
            'tgl_pembayaran' => $this->timestamp()->null(),
            'status_pembayaran' => $this->tinyInteger()->defaultValue(0),
            'tgl_rekon' => $this->timestamp()->null(),
            'status_rekon' => $this->tinyInteger()->defaultValue(0),
            'tgl_reversal' => $this->timestamp()->null(),
            'status_reversal' => $this->tinyInteger()->defaultValue(0),
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
        $this->dropTable('{{%epbb.virtual_account}}');
    }
}
