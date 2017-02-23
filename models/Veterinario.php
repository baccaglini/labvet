<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "veterinario".
 *
 * @property integer $id
 * @property string $nome
 * @property string $crmv
 * @property integer $ativo
 *
 * @property Atendimento[] $atendimentos
 * @property VeterinarioClinica[] $veterinarioClinicas
 * @property Clinica[] $clinicas
 * @property VeterinarioEmail[] $veterinarioEmails
 * @property VeterinarioEndereco $veterinarioEndereco
 * @property VeterinarioFone[] $veterinarioFones
 */
class Veterinario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'veterinario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'crmv'], 'required'],
            [['ativo'], 'integer'],
            [['nome'], 'string', 'max' => 255],
            [['crmv'], 'string', 'max' => 45],
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
            'crmv' => 'Crmv',
            'ativo' => 'Ativo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtendimentos()
    {
        return $this->hasMany(Atendimento::className(), ['veterinario' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVeterinarioClinicas()
    {
        return $this->hasMany(VeterinarioClinica::className(), ['veterinario' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClinicas()
    {
        return $this->hasMany(Clinica::className(), ['id' => 'clinica'])->viaTable('veterinario_clinica', ['veterinario' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVeterinarioEmails()
    {
        return $this->hasMany(VeterinarioEmail::className(), ['veterinario' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVeterinarioEndereco()
    {
        return $this->hasOne(VeterinarioEndereco::className(), ['veterinario' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVeterinarioFones()
    {
        return $this->hasMany(VeterinarioFone::className(), ['veterinario' => 'id']);
    }

    /**
     * @inheritdoc
     * @return VeterinarioQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VeterinarioQuery(get_called_class());
    }
}
