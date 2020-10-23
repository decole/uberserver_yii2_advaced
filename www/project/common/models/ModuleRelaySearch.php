<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ModuleRelay;

/**
 * ModuleRelaySearch represents the model behind the search form of `common\models\ModuleRelay`.
 */
class ModuleRelaySearch extends ModuleRelay
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type', 'location', 'created_at', 'updated_at'], 'integer'],
            [['name', 'topic', 'check_topic', 'command_on', 'command_off', 'check_command_on', 'check_command_off', 'last_command', 'message_info', 'message_ok', 'message_warn'], 'safe'],
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
        $query = ModuleRelay::find();

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
            ->andFilterWhere(['like', 'check_topic', $this->check_topic])
            ->andFilterWhere(['like', 'command_on', $this->command_on])
            ->andFilterWhere(['like', 'command_off', $this->command_off])
            ->andFilterWhere(['like', 'check_command_on', $this->check_command_on])
            ->andFilterWhere(['like', 'check_command_off', $this->check_command_off])
            ->andFilterWhere(['like', 'last_command', $this->last_command])
            ->andFilterWhere(['like', 'message_info', $this->message_info])
            ->andFilterWhere(['like', 'message_ok', $this->message_ok])
            ->andFilterWhere(['like', 'message_warn', $this->message_warn]);

        return $dataProvider;
    }
}
