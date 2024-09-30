<?php

use yii\db\Migration;

/**
 * Class m200826_010305_add_column_biaya_administrasi_to_va_table
 */
class m200826_010305_add_column_biaya_administrasi_to_va_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('epbb.virtual_account', 'biaya_admin', $this->double()->defaultValue(0));

        $this->dropColumn('epbb.virtual_account_detail', 'biaya_admin');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200826_010305_add_column_biaya_administrasi_to_va_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200826_010305_add_column_biaya_administrasi_to_va_table cannot be reverted.\n";

        return false;
    }
    */
}
