<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\SubjekPajak;

/**
 * SubjekPajakSearch represents the model behind the search form of `frontend\models\SubjekPajak`.
 */
class SubjekPajakSearch extends SubjekPajak
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subjek_pajak_id', 'nm_wp', 'jalan_wp', 'blok_kav_no_wp', 'rw_wp', 'rt_wp', 'kelurahan_wp', 'kota_wp', 'kd_pos_wp', 'telp_wp', 'npwp', 'status_pekerjaan_wp', 'createdtime', 'updatedtime', 'handphone'], 'safe'],
            [['createdby', 'updatedby'], 'integer'],
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
        $query = SubjekPajak::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'createdby' => $this->createdby,
            'createdtime' => $this->createdtime,
            'updatedby' => $this->updatedby,
            'updatedtime' => $this->updatedtime,
        ]);

        $query->andFilterWhere(['ilike', 'subjek_pajak_id', $this->subjek_pajak_id])
            ->andFilterWhere(['ilike', 'nm_wp', $this->nm_wp])
            ->andFilterWhere(['ilike', 'jalan_wp', $this->jalan_wp])
            ->andFilterWhere(['ilike', 'blok_kav_no_wp', $this->blok_kav_no_wp])
            ->andFilterWhere(['ilike', 'rw_wp', $this->rw_wp])
            ->andFilterWhere(['ilike', 'rt_wp', $this->rt_wp])
            ->andFilterWhere(['ilike', 'kelurahan_wp', $this->kelurahan_wp])
            ->andFilterWhere(['ilike', 'kota_wp', $this->kota_wp])
            ->andFilterWhere(['ilike', 'kd_pos_wp', $this->kd_pos_wp])
            ->andFilterWhere(['ilike', 'telp_wp', $this->telp_wp])
            ->andFilterWhere(['ilike', 'npwp', $this->npwp])
            ->andFilterWhere(['ilike', 'status_pekerjaan_wp', $this->status_pekerjaan_wp])
            ->andFilterWhere(['ilike', 'handphone', $this->handphone]);

        return $dataProvider;
    }
}
