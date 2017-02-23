<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Exame;

/**
 * ExameSearch represents the model behind the search form about `app\models\Exame`.
 */
class ExameSearch extends Exame
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'prazo'], 'integer'],
            [['exame'], 'safe'],
            [['valor'], 'number'],
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
        $query = Exame::find();

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
            'valor' => $this->valor,
            'prazo' => $this->prazo,
        ]);

        $query->andFilterWhere(['like', 'exame', $this->exame]);

        return $dataProvider;
    }
}
