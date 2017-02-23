<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "amostra".
 *
 * @property integer $id
 * @property string $amostra
 * @property integer $ativo
 *
 * @property ExameAmostra[] $exameAmostras
 * @property Exame[] $exames
 */
class Amostra extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'amostra';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['amostra'], 'required'],
            [['ativo'], 'integer'],
            [['amostra'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'amostra' => 'Amostra',
            'ativo' => 'Ativo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExameAmostras()
    {
        return $this->hasMany(ExameAmostra::className(), ['amostra' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExames()
    {
        return $this->hasMany(Exame::className(), ['id' => 'exame'])->viaTable('exame_amostra', ['amostra' => 'id']);
    }

    /**
     * @inheritdoc
     * @return AmostraQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AmostraQuery(get_called_class());
    }
}
