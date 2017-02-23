<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "especie".
 *
 * @property integer $id
 * @property string $especie
 * @property integer $ativo
 *
 * @property Raca[] $racas
 */
class Especie extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'especie';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['especie'], 'required'],
            [['ativo'], 'integer'],
            [['especie'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'especie' => 'Especie',
            'ativo' => 'Ativo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRacas()
    {
        return $this->hasMany(Raca::className(), ['especie' => 'id']);
    }

    /**
     * @inheritdoc
     * @return EspecieQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EspecieQuery(get_called_class());
    }
}
