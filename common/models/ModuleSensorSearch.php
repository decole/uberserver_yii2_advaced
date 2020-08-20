<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ModuleSensor;

/**
 * ModuleSensorSearch represents the model behind the search form of `common\models\ModuleSensor`.
 */
class ModuleSensorSearch extends ModuleSensor
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type', 'location', 'to_condition', 'from_condition', 'created_at', 'updated_at'], 'integer'],
            [['name', 'topic', 'message_info', 'message_ok', 'message_warn'], 'safe'],
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
        $query = ModuleSensor::find();

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
            'type' => $this->type,
            'location' => $this->location,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'topic', $this->topic])
            ->andFilterWhere(['like', 'to_condition', $this->to_condition])
            ->andFilterWhere(['like', 'from_condition', $this->from_condition])
            ->andFilterWhere(['like', 'message_info', $this->message_info])
            ->andFilterWhere(['like', 'message_ok', $this->message_ok])
            ->andFilterWhere(['like', 'message_warn', $this->message_warn]);

        return $dataProvider;
    }
}
