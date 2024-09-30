<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Aduan;

/**
 * AduanSearch represents the model behind the search form of `frontend\models\Aduan`.
 */
class AduanSearch extends Aduan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'createdby', 'updatedby'], 'integer'],
            [['subjek', 'status', 'createdtime', 'updatedtime'], 'safe'],
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
        $query = Aduan::find();

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
            'id' => $this->id,
            'createdby' => $this->createdby,
            'createdtime' => $this->createdtime,
            'updatedby' => $this->updatedby,
            'updatedtime' => $this->updatedtime,
        ]);

        $query->andFilterWhere(['ilike', 'subjek', $this->subjek])
            ->andFilterWhere(['ilike', 'status', $this->status]);

        return $dataProvider;
    }
}
