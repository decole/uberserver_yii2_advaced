<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ModuleLeakage;

/**
 * ModuleLeakageSearch represents the model behind the search form of `common\models\ModuleLeakage`.
 */
class ModuleLeakageSearch extends ModuleLeakage
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type', 'location', 'notifying', 'active', 'created_at', 'updated_at'], 'integer'],
            [['name', 'topic', 'check_up', 'check_down', 'message_info', 'message_ok', 'message_warn'], 'safe'],
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
        $query = ModuleLeakage::find();

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
            'notifying' => $this->notifying,
            'active' => $this->active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'topic', $this->topic])
            ->andFilterWhere(['like', 'check_up', $this->check_up])
            ->andFilterWhere(['like', 'check_down', $this->check_down])
            ->andFilterWhere(['like', 'message_info', $this->message_info])
            ->andFilterWhere(['like', 'message_ok', $this->message_ok])
            ->andFilterWhere(['like', 'message_warn', $this->message_warn]);

        return $dataProvider;
    }
}
