<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clinica_email".
 *
 * @property integer $clinica
 * @property integer $sequencia
 * @property string $email
 * @property integer $principal
 * @property integer $ativo
 *
 * @property Clinica $clinica0
 */
class ClinicaEmail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clinica_email';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clinica', 'sequencia', 'email'], 'required'],
            [['clinica', 'sequencia', 'principal', 'ativo'], 'integer'],
            [['email'], 'string', 'max' => 45],
            [['clinica'], 'exist', 'skipOnError' => true, 'targetClass' => Clinica::className(), 'targetAttribute' => ['clinica' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'clinica' => 'Clinica',
            'sequencia' => 'Sequencia',
            'email' => 'Email',
            'principal' => 'Principal',
            'ativo' => 'Ativo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClinica0()
    {
        return $this->hasOne(Clinica::className(), ['id' => 'clinica']);
    }

    /**
     * @inheritdoc
     * @return ClinicaEmailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ClinicaEmailQuery(get_called_class());
    }
}
