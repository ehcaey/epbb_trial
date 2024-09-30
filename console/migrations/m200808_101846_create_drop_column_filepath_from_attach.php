<?php

use yii\db\Migration;

/**
 * Class m200808_101846_create_drop_column_filepath_from_attach
 */
class m200808_101846_create_drop_column_filepath_from_attach extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('epbb.attachment_aduan', 'file_path');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200808_101846_create_drop_column_filepath_from_attach cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200808_101846_create_drop_column_filepath_from_attach cannot be reverted.\n";

        return false;
    }
    */
}
