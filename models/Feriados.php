<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "feriados".
 *
 * @property integer $id
 * @property string $feriado
 * @property string $data
 * @property integer $tipo
 * @property integer $ciclico
 *
 * @property TipoFeriado $tipo0
 */
class Feriados extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feriados';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['feriado', 'data', 'tipo'], 'required'],
            [['data'], 'safe'],
            [['tipo', 'ciclico'], 'integer'],
            [['feriado'], 'string', 'max' => 255],
            [['tipo'], 'exist', 'skipOnError' => true, 'targetClass' => TipoFeriado::className(), 'targetAttribute' => ['tipo' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'feriado' => 'Feriado',
            'data' => 'Data',
            'tipo' => 'Tipo',
            'ciclico' => 'Ciclico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipo0()
    {
        return $this->hasOne(TipoFeriado::className(), ['id' => 'tipo']);
    }
}
