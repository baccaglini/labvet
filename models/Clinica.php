<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clinica".
 *
 * @property integer $id
 * @property string $cnpj
 * @property string $nome
 * @property string $razaoSocial
 * @property string $cadastro
 * @property integer $ativo
 *
 * @property Atendimento[] $atendimentos
 * @property ClinicaEmail[] $clinicaEmails
 * @property ClinicaEndereco[] $clinicaEnderecos
 * @property ClinicaFone[] $clinicaFones
 * @property VeterinarioClinica[] $veterinarioClinicas
 * @property Veterinario[] $veterinarios
 */
class Clinica extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clinica';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cnpj', 'nome', 'razaoSocial', 'cadastro'], 'required'],
            [['cadastro'], 'safe'],
            [['ativo'], 'integer'],
            [['cnpj'], 'string', 'max' => 45],
            [['nome', 'razaoSocial'], 'string', 'max' => 255],
            [['cnpj'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cnpj' => 'CNPJ',
            'nome' => 'Nome',
            'razaoSocial' => 'Razao Social',
            'cadastro' => 'Cadastro',
            'ativo' => 'Ativo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtendimentos()
    {
        return $this->hasMany(Atendimento::className(), ['clinica' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClinicaEmails()
    {
        return $this->hasMany(ClinicaEmail::className(), ['clinica' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClinicaEnderecos()
    {
        return $this->hasMany(ClinicaEndereco::className(), ['clinica' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClinicaFones()
    {
        return $this->hasMany(ClinicaFone::className(), ['clinica' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVeterinarioClinicas()
    {
        return $this->hasMany(VeterinarioClinica::className(), ['clinica' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVeterinarios()
    {
        return $this->hasMany(Veterinario::className(), ['id' => 'veterinario'])->viaTable('veterinario_clinica', ['clinica' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ClinicaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ClinicaQuery(get_called_class());
    }
}
