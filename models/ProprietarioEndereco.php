<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proprietario_endereco".
 *
 * @property integer $proprietario
 * @property string $cep
 * @property integer $cidade
 * @property integer $uf
 * @property string $logradouro
 * @property string $numero
 * @property string $bairro
 * @property integer $ativo
 *
 * @property Cidade $cidade0
 * @property Estado $uf0
 * @property Proprietario $proprietario0
 */
class ProprietarioEndereco extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proprietario_endereco';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['proprietario', 'cep', 'cidade', 'uf', 'logradouro', 'numero', 'bairro'], 'required'],
            [['proprietario', 'cidade', 'uf', 'ativo'], 'integer'],
            [['cep'], 'string', 'max' => 11],
            [['logradouro', 'bairro'], 'string', 'max' => 255],
            [['numero'], 'string', 'max' => 6],
            [['cidade'], 'exist', 'skipOnError' => true, 'targetClass' => Cidade::className(), 'targetAttribute' => ['cidade' => 'id']],
            [['uf'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['uf' => 'id']],
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
    public function getUf0()
    {
        return $this->hasOne(Estado::className(), ['id' => 'uf']);
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
     * @return ProprietarioEnderecoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProprietarioEnderecoQuery(get_called_class());
    }
}
