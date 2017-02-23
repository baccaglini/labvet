<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proprietario_email".
 *
 * @property integer $proprietario
 * @property integer $sequencia
 * @property string $email
 * @property integer $principal
 * @property integer $ativo
 *
 * @property Proprietario $proprietario0
 */
class ProprietarioEmail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proprietario_email';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['proprietario', 'sequencia', 'email'], 'required'],
            [['proprietario', 'sequencia', 'principal', 'ativo'], 'integer'],
            [['email'], 'string', 'max' => 255],
            [['proprietario'], 'exist', 'skipOnError' => true, 'targetClass' => Proprietario::className(), 'targetAttribute' => ['proprietario' => 'id']],
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
            'email' => 'Email',
            'principal' => 'Principal',
            'ativo' => 'Ativo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProprietario0()
    {
        return $this->hasOne(Proprietario::className(), ['id' => 'proprietario']);
    }

    /**
     * @inheritdoc
     * @return ProprietarioEmailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProprietarioEmailQuery(get_called_class());
    }
}
