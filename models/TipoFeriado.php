<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_feriado".
 *
 * @property integer $id
 * @property string $descricao
 *
 * @property Feriado[] $feriados
 */
class TipoFeriado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_feriado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descricao'], 'required'],
            [['descricao'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descricao' => 'Descricao',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeriados()
    {
        return $this->hasMany(Feriado::className(), ['tipo' => 'id']);
    }

    /**
     * @inheritdoc
     * @return TipoFeriadoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TipoFeriadoQuery(get_called_class());
    }
}
