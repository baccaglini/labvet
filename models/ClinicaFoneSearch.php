<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ClinicaFone;

/**
 * ClinicaFoneSearch represents the model behind the search form about `app\models\ClinicaFone`.
 */
class ClinicaFoneSearch extends ClinicaFone
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clinica', 'sequencia', 'principal', 'ativo'], 'integer'],
            [['fone', 'obs'], 'safe'],
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
        $query = ClinicaFone::find();

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
            'ativo' => $this->ativo,
        ]);

        $query->andFilterWhere(['like', 'fone', $this->fone])
            ->andFilterWhere(['like', 'obs', $this->obs]);

        return $dataProvider;
    }
}
