<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "veterinario_email".
 *
 * @property integer $veterinario
 * @property integer $sequencia
 * @property string $email
 * @property integer $principal
 * @property integer $ativo
 *
 * @property Veterinario $veterinario0
 */
class VeterinarioEmail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'veterinario_email';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['veterinario', 'sequencia', 'email'], 'required'],
            [['veterinario', 'sequencia', 'principal', 'ativo'], 'integer'],
            [['email'], 'string', 'max' => 150],
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
            'sequencia' => 'Sequencia',
            'email' => 'Email',
            'principal' => 'Principal',
            'ativo' => 'Ativo',
        ];
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
     * @return VeterinarioEmailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VeterinarioEmailQuery(get_called_class());
    }
}
