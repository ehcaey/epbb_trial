<?php

use yii\db\Migration;

/**
 * Class m200815_033007_add_column_user_id_to_pst_permohonan_table
 */
class m200806_033007_add_column_user_id_to_pst_permohonan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('pbb.pst_permohonan', 'epbb_user_id', $this->integer()->null());

        $this->createIndex(
            'idx-pst_permohonan-user_id',
            'pbb.pst_permohonan',
            'epbb_user_id'
        );

        $this->addForeignKey(
            'fk-pst_permohonan-user_id',
            'pbb.pst_permohonan',
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
            'fk-pst_permohonan-user_id',
            'pbb.pst_permohonan'
        );

        $this->dropIndex(
            'idx-pst_permohonan-user_id',
            'pbb.pst_permohonan'
        );
        
        $this->dropColumn('pbb.pst_permohonan', 'epbb_user_id', $this->integer());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200815_033007_add_column_user_id_to_pst_permohonan_table cannot be reverted.\n";

        return false;
    }
    */
}
