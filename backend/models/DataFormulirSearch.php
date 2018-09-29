<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\DataFormulirModel;

/**
 * DataFormulirSearch represents the model behind the search form of `backend\models\DataFormulirModel`.
 */
class DataFormulirSearch extends DataFormulirModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_formulir'], 'integer'],
            [['nama_data', 'datatype'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
    public function search($params,$id)
    {
        $query = DataFormulirModel::find();

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
        $query->andWhere(['id_formulir' => $id]);
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_formulir' => $this->id_formulir,
        ]);

        $query->andFilterWhere(['like', 'nama_data', $this->nama_data])
            ->andFilterWhere(['like', 'datatype', $this->datatype]);

        return $dataProvider;
    }
}
