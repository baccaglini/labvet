<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "exame".
 *
 * @property integer $id
 * @property string $exame
 * @property double $valor
 * @property integer $prazo
 * @property integer $ativo 
 *
 * @property ExameAmostra[] $exameAmostras
 * @property Amostra[] $amostras
 */
class Exame extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exame';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['exame', 'valor', 'prazo'], 'required'],
            [['valor'], 'number'],
            [['prazo', 'ativo'], 'integer'],
            [['exame'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'exame' => 'Exame',
            'valor' => 'Valor (R$)',
            'prazo' => 'Prazo (Dias)',
            'ativo' => 'Ativo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExameAmostras()
    {
        return $this->hasMany(ExameAmostra::className(), ['exame' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmostras()
    {
        return $this->hasMany(Amostra::className(), ['id' => 'amostra'])->viaTable('exame_amostra', ['exame' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ExameQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ExameQuery(get_called_class());
    }
}
