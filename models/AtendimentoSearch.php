<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Atendimento;

/**
 * AtendimentoSearch represents the model behind the search form about `app\models\Atendimento`.
 */
class AtendimentoSearch extends Atendimento
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'proprietario', 'sequencia', 'veterinario', 'clinica', 'usuario', 'ativo'], 'integer'],
            [['cadastro'], 'safe'],
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
        $query = Atendimento::find();

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
            'proprietario' => $this->proprietario,
            'sequencia' => $this->sequencia,
            'veterinario' => $this->veterinario,
            'clinica' => $this->clinica,
            'usuario' => $this->usuario,
            'cadastro' => $this->cadastro,
            'ativo' => $this->ativo,
        ]);

        return $dataProvider;
    }
}
