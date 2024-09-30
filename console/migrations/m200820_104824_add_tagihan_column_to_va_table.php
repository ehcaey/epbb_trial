<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%va}}`.
 */
class m200820_104824_add_tagihan_column_to_va_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('epbb.virtual_account', 'tagihan', $this->double()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
