<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "raca".
 *
 * @property integer $id
 * @property integer $especie
 * @property string $raca
 * @property integer $ativo
 *
 * @property ProprietarioAnimal[] $proprietarioAnimals
 * @property Especie $especie0
 */
class Raca extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'raca';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['especie', 'raca'], 'required'],
            [['especie', 'ativo'], 'integer'],
            [['raca'], 'string', 'max' => 255],
            [['especie'], 'exist', 'skipOnError' => true, 'targetClass' => Especie::className(), 'targetAttribute' => ['especie' => 'id']],
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
            'raca' => 'Raca',
            'ativo' => 'Ativo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProprietarioAnimals()
    {
        return $this->hasMany(ProprietarioAnimal::className(), ['raca' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEspecie0()
    {
        return $this->hasOne(Especie::className(), ['id' => 'especie']);
    }

    /**
     * @inheritdoc
     * @return RacaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RacaQuery(get_called_class());
    }
}
