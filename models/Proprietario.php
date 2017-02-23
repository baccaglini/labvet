<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proprietario".
 *
 * @property integer $id
 * @property string $nome
 * @property string $cpf
 * @property integer $ativo
 *
 * @property ProprietarioAnimal[] $proprietarioAnimals
 * @property ProprietarioEmail[] $proprietarioEmails
 * @property ProprietarioEndereco $proprietarioEndereco
 * @property ProprietarioFone[] $proprietarioFones
 */
class Proprietario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proprietario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['ativo'], 'integer'],
            [['nome'], 'string', 'max' => 255],
            [['cpf'], 'string'/*, 'max' => 11*/],
            [['cpf'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'cpf' => 'Cpf',
            'ativo' => 'Ativo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProprietarioAnimals()
    {
        return $this->hasMany(ProprietarioAnimal::className(), ['proprietario' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProprietarioEmails()
    {
        return $this->hasMany(ProprietarioEmail::className(), ['proprietario' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProprietarioEndereco()
    {
        return $this->hasOne(ProprietarioEndereco::className(), ['proprietario' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProprietarioFones()
    {
        return $this->hasMany(ProprietarioFone::className(), ['proprietario' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ProprietarioQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProprietarioQuery(get_called_class());
    }
}
