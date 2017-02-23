<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "acesso".
 *
 * @property integer $usuario
 * @property string $data
 * @property string $ip
 *
 * @property Administrador $usuario0
 */
class Acesso extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'acesso';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario', 'data', 'ip'], 'required'],
            [['usuario'], 'integer'],
            [['data'], 'safe'],
            [['ip'], 'string', 'max' => 100],
            [['usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Administrador::className(), 'targetAttribute' => ['usuario' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'usuario' => 'Usuario',
            'data' => 'Data',
            'ip' => 'Ip',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario0()
    {
        return $this->hasOne(Administrador::className(), ['id' => 'usuario']);
    }

    /**
     * @inheritdoc
     * @return AcessoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AcessoQuery(get_called_class());
    }
}
