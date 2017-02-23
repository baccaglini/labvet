<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clinica_endereco".
 *
 * @property integer $clinica
 * @property integer $sequencia
 * @property integer $principal
 * @property string $cep
 * @property integer $cidade
 * @property integer $uf
 * @property string $logradouro
 * @property string $numero
 * @property string $bairro
 * @property integer $ativo
 *
 * @property Cidade $cidade0
 * @property Clinica $clinica0
 * @property Estado $uf0
 */
class ClinicaEndereco extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clinica_endereco';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clinica', 'sequencia', 'principal', 'cep', 'cidade', 'uf', 'logradouro', 'numero', 'bairro'], 'required'],
            [['clinica', 'sequencia', 'principal', 'cidade', 'uf', 'ativo'], 'integer'],
            [['cep'], 'string', 'max' => 11],
            [['logradouro', 'bairro'], 'string', 'max' => 255],
            [['numero'], 'string', 'max' => 6],
            [['cidade'], 'exist', 'skipOnError' => true, 'targetClass' => Cidade::className(), 'targetAttribute' => ['cidade' => 'id']],
            [['clinica'], 'exist', 'skipOnError' => true, 'targetClass' => Clinica::className(), 'targetAttribute' => ['clinica' => 'id']],
            [['uf'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['uf' => 'id']],
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
            'cep' => 'Cep',
            'cidade' => 'Cidade',
            'uf' => 'Uf',
            'logradouro' => 'Logradouro',
            'numero' => 'Numero',
            'bairro' => 'Bairro',
            'ativo' => 'Ativo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCidade0()
    {
        return $this->hasOne(Cidade::className(), ['id' => 'cidade']);
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
    public function getUf0()
    {
        return $this->hasOne(Estado::className(), ['id' => 'uf']);
    }

    /**
     * @inheritdoc
     * @return ClinicaEnderecoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ClinicaEnderecoQuery(get_called_class());
    }
}
