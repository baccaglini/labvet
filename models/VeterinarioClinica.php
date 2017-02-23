<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "veterinario_clinica".
 *
 * @property integer $veterinario
 * @property integer $clinica
 * @property integer $ativo
 *
 * @property Clinica $clinica0
 * @property Veterinario $veterinario0
 */
class VeterinarioClinica extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'veterinario_clinica';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['veterinario', 'clinica'], 'required'],
            [['veterinario', 'clinica', 'ativo'], 'integer'],
            [['clinica'], 'exist', 'skipOnError' => true, 'targetClass' => Clinica::className(), 'targetAttribute' => ['clinica' => 'id']],
            [['veterinario'], 'exist', 'skipOnError' => true, 'targetClass' => Veterinario::className(), 'targetAttribute' => ['veterinario' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'veterinario' => 'Veterinario',
            'clinica' => 'Clinica',
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
     * @return \yii\db\ActiveQuery
     */
    public function getVeterinario0()
    {
        return $this->hasOne(Veterinario::className(), ['id' => 'veterinario']);
    }

    /**
     * @inheritdoc
     * @return VeterinarioClinicaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VeterinarioClinicaQuery(get_called_class());
    }
}
