<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proprietario_fone".
 *
 * @property integer $proprietario
 * @property integer $sequencia
 * @property string $fone
 * @property string $obs
 * @property integer $ativo
 *
 * @property Proprietario $proprietario0
 */
class ProprietarioFone extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proprietario_fone';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['proprietario', 'sequencia', 'fone'], 'required'],
            [['proprietario', 'sequencia', 'ativo'], 'integer'],
            [['obs'], 'string'],
            [['fone'], 'string', 'max' => 45],
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
            'fone' => 'Fone',
            'obs' => 'Obs',
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
     * @return ProprietarioFoneQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProprietarioFoneQuery(get_called_class());
    }
}
