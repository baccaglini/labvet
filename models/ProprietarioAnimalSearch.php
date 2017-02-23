<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProprietarioAnimal;

/**
 * ProprietarioAnimalSearch represents the model behind the search form about `app\models\ProprietarioAnimal`.
 */
class ProprietarioAnimalSearch extends ProprietarioAnimal {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['sequencia', 'ativo'], 'integer'],
            [['proprietario', 'raca', 'animal', 'sexo', 'cor', 'nascimento', 'obs'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = ProprietarioAnimal::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $query->joinWith('raca0');
        $query->joinWith('proprietario0');
        

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'sequencia' => $this->sequencia,
            'nascimento' => $this->nascimento,
            'ativo' => $this->ativo,
        ]);

        $query->andFilterWhere(['like', 'proprietario.nome', $this->proprietario])
                ->andFilterWhere(['like', 'animal', $this->animal])
                ->andFilterWhere(['like', 'sexo', $this->sexo])
                ->andFilterWhere(['like', 'cor', $this->cor])
                ->andFilterWhere(['like', 'obs', $this->obs])
                ->andFilterWhere(['like', 'raca.raca', $this->raca]);

        return $dataProvider;
    }

}
