<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cidade;

/**
 * CidadeSearch represents the model behind the search form about `app\models\Cidade`.
 */
class CidadeSearch extends Cidade
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'flAtivo', 'prioridade'], 'integer'],
            [['nmCidades', 'idEstado'], 'safe'],
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
        $query = Cidade::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $query->joinWith('idEstado0');
        
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'cidade.id' => $this->id,
            'cidade.flAtivo' => $this->flAtivo,
            'cidade.prioridade' => $this->prioridade,
        ]);

        $query->andFilterWhere(['like', 'nmCidades', $this->nmCidades])
                ->andFilterWhere(['like', 'estado.nmEstado', $this->idEstado]);

        return $dataProvider;
    }
}
