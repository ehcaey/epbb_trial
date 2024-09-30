<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%pst_lampiran}}`.
 */
class m200815_041131_add_columns_to_pst_lampiran_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('pbb.pst_lampiran', 'l_pbb_tetangga', $this->smallInteger()->defaultValue(0));
        $this->addColumn('pbb.pst_lampiran', 'l_pbb_induk', $this->smallInteger()->defaultValue(0));
        $this->addColumn('pbb.pst_lampiran', 'l_foto_lokasi', $this->smallInteger()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('pbb.pst_lampiran', 'l_pbb_tetangga');
        $this->dropColumn('pbb.pst_lampiran', 'l_pbb_induk');
        $this->dropColumn('pbb.pst_lampiran', 'l_foto_lokasi');
    }
}
