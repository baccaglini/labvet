<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cidade".
 *
 * @property integer $id
 * @property integer $idEstado
 * @property string $nmCidades
 * @property integer $flAtivo
 * @property integer $prioridade
 *
 * @property Estado $idEstado0
 * @property ClinicaEndereco[] $clinicaEnderecos
 * @property ProprietarioEndereco[] $proprietarioEnderecos
 * @property VeterinarioEndereco[] $veterinarioEnderecos
 */
class Cidade extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cidade';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idEstado', 'nmCidades'], 'required'],
            [['idEstado', 'flAtivo', 'prioridade'], 'integer'],
            [['nmCidades'], 'string', 'max' => 255],
            [['idEstado'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['idEstado' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idEstado' => 'Estado',
            'nmCidades' => 'Cidades',
            'flAtivo' => 'Ativo',
            'prioridade' => 'Prioridade',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEstado0()
    {
        return $this->hasOne(Estado::className(), ['id' => 'idEstado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClinicaEnderecos()
    {
        return $this->hasMany(ClinicaEndereco::className(), ['cidade' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProprietarioEnderecos()
    {
        return $this->hasMany(ProprietarioEndereco::className(), ['cidade' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVeterinarioEnderecos()
    {
        return $this->hasMany(VeterinarioEndereco::className(), ['cidade' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CidadeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CidadeQuery(get_called_class());
    }
}
