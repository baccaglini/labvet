<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AtendimentoExame;

/**
 * AtendimentoExameSearch represents the model behind the search form about `app\models\AtendimentoExame`.
 */
class AtendimentoExameSearch extends AtendimentoExame
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['atendimento', 'exame', 'amostra', 'usuario', 'ativo'], 'integer'],
            [['coleta', 'liberacao', 'obs', 'cadastro'], 'safe'],
            [['valor', 'laudo'], 'number'],
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
        $query = AtendimentoExame::find();

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
            'atendimento' => $this->atendimento,
            'exame' => $this->exame,
            'amostra' => $this->amostra,
            'valor' => $this->valor,
            'liberacao' => $this->liberacao,
            'usuario' => $this->usuario,
            'cadastro' => $this->cadastro,
            'ativo' => $this->ativo,
            'laudo' => $this->laudo,
        ]);

        $query->andFilterWhere(['like', 'coleta', $this->coleta])
            ->andFilterWhere(['like', 'obs', $this->obs]);

        return $dataProvider;
    }
}
