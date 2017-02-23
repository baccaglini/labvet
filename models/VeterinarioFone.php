<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "veterinario_fone".
 *
 * @property integer $veterinario
 * @property integer $sequencia
 * @property integer $principal
 * @property string $fone
 * @property string $obs
 * @property integer $ativo
 *
 * @property Veterinario $veterinario0
 */
class VeterinarioFone extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'veterinario_fone';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['veterinario', 'sequencia', 'fone'], 'required'],
            [['veterinario', 'sequencia', 'principal', 'ativo'], 'integer'],
            [['obs'], 'string'],
            [['fone'], 'string', 'max' => 45],
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
            'principal' => 'Principal',
            'fone' => 'Fone',
            'obs' => 'Obs',
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
     * @return VeterinarioFoneQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VeterinarioFoneQuery(get_called_class());
    }
}
