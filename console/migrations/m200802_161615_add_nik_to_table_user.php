<?php

use yii\db\Migration;

/**
 * Class m200802_161615_add_nik_to_table_user
 */
class m200802_161615_add_nik_to_table_user extends Migration
{
    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('{{%epbb.user}}', 'nik', $this->string(16)->defaultValue(null));
    }

    public function down()
    {
        echo "m200802_161615_add_nik_to_table_user cannot be reverted.\n";

        return false;
    }
    
}
