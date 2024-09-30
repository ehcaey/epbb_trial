<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ObjekPajak;
use Yii;

/**
 * ObjekPajakSearch represents the model behind the search form of `app\models\ObjekPajak`.
 */
class ObjekPajakSearch extends ObjekPajak
{
    public $nop;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nop', 'kd_propinsi', 'kd_dati2', 'kd_kecamatan', 'kd_kelurahan', 'kd_blok', 'no_urut', 'kd_jns_op', 'subjek_pajak_id', 'no_formulir_spop', 'no_persil', 'jalan_op', 'blok_kav_no_op', 'rw_op', 'rt_op', 'kd_status_wp', 'jns_transaksi_op', 'tgl_pendataan_op', 'nip_pendata', 'tgl_pemeriksaan_op', 'nip_pemeriksa_op', 'tgl_perekaman_op', 'nip_perekam_op', 'createdtime', 'updatedtime'], 'safe'],
            [['kd_status_cabang', 'total_luas_bumi', 'total_luas_bng', 'njop_bumi', 'njop_bng', 'status_peta_op', 'createdby', 'updatedby'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ObjekPajak::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andWhere(['epbb_user_id' => Yii::$app->user->id]);

        // grid filtering conditions
        $query->andFilterWhere([
            'kd_status_cabang' => $this->kd_status_cabang,
            'total_luas_bumi' => $this->total_luas_bumi,
            'total_luas_bng' => $this->total_luas_bng,
            'njop_bumi' => $this->njop_bumi,
            'njop_bng' => $this->njop_bng,
            'status_peta_op' => $this->status_peta_op,
            'tgl_pendataan_op' => $this->tgl_pendataan_op,
            'tgl_pemeriksaan_op' => $this->tgl_pemeriksaan_op,
            'tgl_perekaman_op' => $this->tgl_perekaman_op,
            'createdby' => $this->createdby,
            'createdtime' => $this->createdtime,
            'updatedby' => $this->updatedby,
            'updatedtime' => $this->updatedtime,
        ]);

        $query->andFilterWhere(['ilike', 'CONCAT(kd_propinsi, kd_dati2, kd_kecamatan, kd_kelurahan, kd_blok, no_urut, kd_jns_op)', $this->nop])
            ->andFilterWhere(['ilike', 'kd_propinsi', $this->kd_propinsi])
            ->andFilterWhere(['ilike', 'kd_dati2', $this->kd_dati2])
            ->andFilterWhere(['ilike', 'kd_kecamatan', $this->kd_kecamatan])
            ->andFilterWhere(['ilike', 'kd_kelurahan', $this->kd_kelurahan])
            ->andFilterWhere(['ilike', 'kd_blok', $this->kd_blok])
            ->andFilterWhere(['ilike', 'no_urut', $this->no_urut])
            ->andFilterWhere(['ilike', 'kd_jns_op', $this->kd_jns_op])
            ->andFilterWhere(['ilike', 'subjek_pajak_id', $this->subjek_pajak_id])
            ->andFilterWhere(['ilike', 'no_formulir_spop', $this->no_formulir_spop])
            ->andFilterWhere(['ilike', 'no_persil', $this->no_persil])
            ->andFilterWhere(['ilike', 'jalan_op', $this->jalan_op])
            ->andFilterWhere(['ilike', 'blok_kav_no_op', $this->blok_kav_no_op])
            ->andFilterWhere(['ilike', 'rw_op', $this->rw_op])
            ->andFilterWhere(['ilike', 'rt_op', $this->rt_op])
            ->andFilterWhere(['ilike', 'kd_status_wp', $this->kd_status_wp])
            ->andFilterWhere(['ilike', 'jns_transaksi_op', $this->jns_transaksi_op])
            ->andFilterWhere(['ilike', 'nip_pendata', $this->nip_pendata])
            ->andFilterWhere(['ilike', 'nip_pemeriksa_op', $this->nip_pemeriksa_op])
            ->andFilterWhere(['ilike', 'nip_perekam_op', $this->nip_perekam_op]);

        return $dataProvider;
    }
}
