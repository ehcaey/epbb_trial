<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\VirtualAccount;
use Yii;

/**
 * VirtualAccountSearch represents the model behind the search form of `frontend\models\VirtualAccount`.
 */
class VirtualAccountSearch extends VirtualAccount
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'no_arsip', 'status_pembayaran', 'status_rekon', 'status_reversal', 'createdby', 'updatedby'], 'integer'],
            [['no_va', 'kd_propinsi', 'kd_dati2', 'kd_kecamatan', 'kd_kelurahan', 'kd_blok', 'no_urut', 'kd_jns_op', 'alamat_op', 'kota_op', 'tgl_pembayaran', 'tgl_rekon', 'tgl_reversal', 'createdtime', 'updatedtime'], 'safe'],
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
        $query = VirtualAccount::find();

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

        $query->andWhere(['createdby' => Yii::$app->user->id]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'no_arsip' => $this->no_arsip,
            'tgl_pembayaran' => $this->tgl_pembayaran,
            'status_pembayaran' => $this->status_pembayaran,
            'tgl_rekon' => $this->tgl_rekon,
            'status_rekon' => $this->status_rekon,
            'tgl_reversal' => $this->tgl_reversal,
            'status_reversal' => $this->status_reversal,
            'createdby' => $this->createdby,
            'createdtime' => $this->createdtime,
            'updatedby' => $this->updatedby,
            'updatedtime' => $this->updatedtime,
        ]);

        $query->andFilterWhere(['ilike', 'no_va', $this->no_va])
            ->andFilterWhere(['ilike', 'kd_propinsi', $this->kd_propinsi])
            ->andFilterWhere(['ilike', 'kd_dati2', $this->kd_dati2])
            ->andFilterWhere(['ilike', 'kd_kecamatan', $this->kd_kecamatan])
            ->andFilterWhere(['ilike', 'kd_kelurahan', $this->kd_kelurahan])
            ->andFilterWhere(['ilike', 'kd_blok', $this->kd_blok])
            ->andFilterWhere(['ilike', 'no_urut', $this->no_urut])
            ->andFilterWhere(['ilike', 'kd_jns_op', $this->kd_jns_op])
            ->andFilterWhere(['ilike', 'alamat_op', $this->alamat_op])
            ->andFilterWhere(['ilike', 'kota_op', $this->kota_op]);

        return $dataProvider;
    }
}
