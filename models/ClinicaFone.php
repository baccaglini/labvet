<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clinica_fone".
 *
 * @property integer $clinica
 * @property integer $sequencia
 * @property integer $principal
 * @property string $fone
 * @property string $obs
 * @property integer $ativo
 *
 * @property Clinica $clinica0
 */
class ClinicaFone extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clinica_fone';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clinica', 'sequencia', 'fone'], 'required'],
            [['clinica', 'sequencia', 'principal', 'ativo'], 'integer'],
            [['obs'], 'string'],
            [['fone'], 'string', 'max' => 45],
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
            'principal' => 'Principal',
            'fone' => 'Fone',
            'obs' => 'Obs',
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
     * @return ClinicaFoneQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ClinicaFoneQuery(get_called_class());
    }
}
