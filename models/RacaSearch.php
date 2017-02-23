<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Raca;

/**
 * RacaSearch represents the model behind the search form about `app\models\Raca`.
 */
class RacaSearch extends Raca
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ativo'], 'integer'],   // aki
            [['raca', 'especie'], 'safe'],  // aki
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
        $query = Raca::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        
        $query->joinWith('especie0'); // aki

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'ativo' => $this->ativo,
        ]);

        $query->andFilterWhere(['like', 'raca', $this->raca])
                ->andFilterWhere(['like', 'especie.especie', $this->especie]);  // aki

        return $dataProvider;
    }
}
