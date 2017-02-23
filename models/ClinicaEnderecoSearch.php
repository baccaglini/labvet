<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ClinicaEndereco;

/**
 * ClinicaEnderecoSearch represents the model behind the search form about `app\models\ClinicaEndereco`.
 */
class ClinicaEnderecoSearch extends ClinicaEndereco
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clinica', 'sequencia', 'principal', 'cidade', 'uf', 'ativo'], 'integer'],
            [['cep', 'logradouro', 'numero', 'bairro'], 'safe'],
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
        $query = ClinicaEndereco::find();

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
            'clinica' => $this->clinica,
            'sequencia' => $this->sequencia,
            'principal' => $this->principal,
            'cidade' => $this->cidade,
            'uf' => $this->uf,
            'ativo' => $this->ativo,
        ]);

        $query->andFilterWhere(['like', 'cep', $this->cep])
            ->andFilterWhere(['like', 'logradouro', $this->logradouro])
            ->andFilterWhere(['like', 'numero', $this->numero])
            ->andFilterWhere(['like', 'bairro', $this->bairro]);

        return $dataProvider;
    }
}
