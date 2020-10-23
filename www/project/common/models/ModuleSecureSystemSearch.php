<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ModuleSecureSystem;

/**
 * ModuleSecureSystemSearch represents the model behind the search form of `common\models\ModuleSecureSystem`.
 */
class ModuleSecureSystemSearch extends ModuleSecureSystem
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'trigger', 'type', 'location', 'created_at', 'updated_at', 'notifying', 'active'], 'integer'],
            [['name', 'topic', 'normal_condition', 'alarm_condition', 'current_command', 'message_info', 'message_ok', 'message_warn'], 'safe'],
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
        $query = ModuleSecureSystem::find();

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
            'trigger' => $this->trigger,
            'type' => $this->type,
            'location' => $this->location,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'notifying' => $this->notifying,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'topic', $this->topic])
            ->andFilterWhere(['like', 'normal_condition', $this->normal_condition])
            ->andFilterWhere(['like', 'alarm_condition', $this->alarm_condition])
            ->andFilterWhere(['like', 'current_command', $this->current_command])
            ->andFilterWhere(['like', 'message_info', $this->message_info])
            ->andFilterWhere(['like', 'message_ok', $this->message_ok])
            ->andFilterWhere(['like', 'message_warn', $this->message_warn]);

        return $dataProvider;
    }
}
