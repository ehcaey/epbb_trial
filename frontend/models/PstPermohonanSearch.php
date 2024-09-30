<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\PstPermohonan;
use Yii;

/**
 * PstPermohonanSearch represents the model behind the search form of `frontend\models\PstPermohonan`.
 */
class PstPermohonanSearch extends PstPermohonan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kd_kanwil', 'kd_kantor', 'thn_pelayanan', 'bundel_pelayanan', 'no_urut_pelayanan', 'no_srt_permohonan', 'tgl_surat_permohonan', 'nama_pemohon', 'alamat_pemohon', 'keterangan_pst', 'catatan_pst', 'status_kolektif', 'tgl_terima_dokumen_wp', 'tgl_perkiraan_selesai', 'nip_penerima', 'createdtime', 'updatedtime'], 'safe'],
            [['createdby', 'updatedby', 'id_tujuan', 'status', 'status_hapus'], 'integer'],
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
        $query = PstPermohonan::find();

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
            'tgl_surat_permohonan' => $this->tgl_surat_permohonan,
            'tgl_terima_dokumen_wp' => $this->tgl_terima_dokumen_wp,
            'tgl_perkiraan_selesai' => $this->tgl_perkiraan_selesai,
            'createdby' => $this->createdby,
            'createdtime' => $this->createdtime,
            'updatedby' => $this->updatedby,
            'updatedtime' => $this->updatedtime,
            'id_tujuan' => $this->id_tujuan,
            'status' => $this->status,
            'status_hapus' => $this->status_hapus,
        ]);

        $query->andFilterWhere(['ilike', 'kd_kanwil', $this->kd_kanwil])
            ->andFilterWhere(['ilike', 'kd_kantor', $this->kd_kantor])
            ->andFilterWhere(['ilike', 'thn_pelayanan', $this->thn_pelayanan])
            ->andFilterWhere(['ilike', 'bundel_pelayanan', $this->bundel_pelayanan])
            ->andFilterWhere(['ilike', 'no_urut_pelayanan', $this->no_urut_pelayanan])
            ->andFilterWhere(['ilike', 'no_srt_permohonan', $this->no_srt_permohonan])
            ->andFilterWhere(['ilike', 'nama_pemohon', $this->nama_pemohon])
            ->andFilterWhere(['ilike', 'alamat_pemohon', $this->alamat_pemohon])
            ->andFilterWhere(['ilike', 'keterangan_pst', $this->keterangan_pst])
            ->andFilterWhere(['ilike', 'catatan_pst', $this->catatan_pst])
            ->andFilterWhere(['ilike', 'status_kolektif', $this->status_kolektif])
            ->andFilterWhere(['ilike', 'nip_penerima', $this->nip_penerima]);

        return $dataProvider;
    }
}
