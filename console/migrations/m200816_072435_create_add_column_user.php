<?php

use yii\db\Migration;

/**
 * Class m200816_072435_create_add_column_user
 */
class m200816_072435_create_add_column_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('epbb.user', 'nama', $this->string(50));
        $this->addColumn('epbb.user', 'alamat', $this->string());
        $this->addColumn('epbb.user', 'no_hp', $this->string(20));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200816_072435_create_add_column_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200816_072435_create_add_column_user cannot be reverted.\n";

        return false;
    }
    */
}
