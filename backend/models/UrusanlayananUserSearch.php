<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UrusanlayananUserModel;

/**
 * UrusanlayananUserSearch represents the model behind the search form of `backend\models\UrusanlayananUserModel`.
 */
class UrusanlayananUserSearch extends UrusanlayananUserModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_urusanlayanan'], 'integer'],
            [['id_user', 'tanggal', 'status', 'komentar'], 'safe'],
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
    public function search($params)
    {
        $query = UrusanlayananUserModel::find();

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
            'id_urusanlayanan' => $this->id_urusanlayanan,
            'tanggal' => $this->tanggal,
        ]);

        $query->andFilterWhere(['like', 'id_user', $this->id_user])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'komentar', $this->komentar]);
        $query->orderBy("tanggal DESC");
        return $dataProvider;
    }
}
