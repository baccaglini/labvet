<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proprietario_animal".
 *
 * @property integer $proprietario
 * @property integer $sequencia
 * @property string $animal
 * @property integer $raca
 * @property string $sexo
 * @property string $cor
 * @property string $nascimento
 * @property string $obs
 * @property integer $ativo
 *
 * @property Atendimento[] $atendimentos
 * @property Proprietario $proprietario0
 * @property Raca $raca0
 */
class ProprietarioAnimal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proprietario_animal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['proprietario', 'sequencia', 'animal', 'raca', 'sexo', 'cor'], 'required'],
            [['proprietario', 'sequencia', 'raca', 'ativo'], 'integer'],
            [['nascimento'], 'safe'],
            [['obs'], 'string'],
            [['animal'], 'string', 'max' => 255],
            [['sexo'], 'string', 'max' => 2],
            [['cor'], 'string', 'max' => 45],
            [['proprietario'], 'exist', 'skipOnError' => true, 'targetClass' => Proprietario::className(), 'targetAttribute' => ['proprietario' => 'id']],
            [['raca'], 'exist', 'skipOnError' => true, 'targetClass' => Raca::className(), 'targetAttribute' => ['raca' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'proprietario' => 'Proprietario',
            'sequencia' => 'Sequencia',
            'animal' => 'Animal',
            'raca' => 'Raca',
            'sexo' => 'Sexo',
            'cor' => 'Cor',
            'nascimento' => 'Nascimento',
            'obs' => 'Obs',
            'ativo' => 'Ativo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtendimentos()
    {
        return $this->hasMany(Atendimento::className(), ['proprietario' => 'proprietario', 'sequencia' => 'sequencia']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProprietario0()
    {
        return $this->hasOne(Proprietario::className(), ['id' => 'proprietario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRaca0()
    {
        return $this->hasOne(Raca::className(), ['id' => 'raca']);
    }

    /**
     * @inheritdoc
     * @return ProprietarioAnimalQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProprietarioAnimalQuery(get_called_class());
    }
}
