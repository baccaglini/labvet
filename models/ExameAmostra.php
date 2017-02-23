<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "exame_amostra".
 *
 * @property integer $exame
 * @property integer $amostra
 * @property integer $ativo
 *
 * @property Atendimento[] $atendimentos
 * @property Amostra $amostra0
 * @property Exame $exame0
 */
class ExameAmostra extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exame_amostra';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['exame', 'amostra'], 'required'],
            [['exame', 'amostra', 'ativo'], 'integer'],
            [['amostra'], 'exist', 'skipOnError' => true, 'targetClass' => Amostra::className(), 'targetAttribute' => ['amostra' => 'id']],
            [['exame'], 'exist', 'skipOnError' => true, 'targetClass' => Exame::className(), 'targetAttribute' => ['exame' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'exame' => 'Exame',
            'amostra' => 'Amostra',
            'ativo' => 'Ativo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtendimentos()
    {
        return $this->hasMany(Atendimento::className(), ['exame' => 'exame', 'amostra' => 'amostra']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmostra0()
    {
        return $this->hasOne(Amostra::className(), ['id' => 'amostra']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExame0()
    {
        return $this->hasOne(Exame::className(), ['id' => 'exame']);
    }

    /**
     * @inheritdoc
     * @return ExameAmostraQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ExameAmostraQuery(get_called_class());
    }
}
