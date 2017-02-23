<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "veterinario_endereco".
 *
 * @property integer $veterinario
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
 * @property Veterinario $veterinario0
 */
class VeterinarioEndereco extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'veterinario_endereco';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['veterinario', 'cep', 'cidade', 'uf', 'logradouro', 'numero', 'bairro'], 'required'],
            [['veterinario', 'cidade', 'uf', 'ativo'], 'integer'],
            [['cep'], 'string', 'max' => 11],
            [['logradouro', 'bairro'], 'string', 'max' => 255],
            [['numero'], 'string', 'max' => 6],
            [['cidade'], 'exist', 'skipOnError' => true, 'targetClass' => Cidade::className(), 'targetAttribute' => ['cidade' => 'id']],
            [['uf'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['uf' => 'id']],
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
    public function getVeterinario0()
    {
        return $this->hasOne(Veterinario::className(), ['id' => 'veterinario']);
    }

    /**
     * @inheritdoc
     * @return VeterinarioEnderecoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VeterinarioEnderecoQuery(get_called_class());
    }
}
