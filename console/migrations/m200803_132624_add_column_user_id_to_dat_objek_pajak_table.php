<?php

use yii\db\Migration;

/**
 * Class m200803_132624_add_column_user_id_to_dat_objek_pajak_table
 */
class m200803_132624_add_column_user_id_to_dat_objek_pajak_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('pbb.dat_objek_pajak', 'epbb_user_id', $this->integer()->null());

        $this->createIndex(
            'idx-dat_objek_pajak-user_id',
            'pbb.dat_objek_pajak',
            'epbb_user_id'
        );

        $this->addForeignKey(
            'fk-dat_objek_pajak-user_id',
            'pbb.dat_objek_pajak',
            'epbb_user_id',
            'epbb.user',
            'id',
            'SET NULL'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-dat_objek_pajak-user_id',
            'pbb.dat_objek_pajak'
        );

        $this->dropIndex(
            'idx-dat_objek_pajak-user_id',
            'pbb.dat_objek_pajak'
        );
        
        $this->dropColumn('pbb.dat_objek_pajak', 'epbb_user_id', $this->integer());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200803_132624_add_column_user_id_to_dat_objek_pajak_table cannot be reverted.\n";

        return false;
    }
    */
}
