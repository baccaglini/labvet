<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estado".
 *
 * @property integer $id
 * @property string $sgEstado
 * @property string $nmEstado
 * @property integer $flAtivo
 * @property integer $prioridade
 *
 * @property Cidade[] $cidades
 * @property ClinicaEndereco[] $clinicaEnderecos
 * @property ProprietarioEndereco[] $proprietarioEnderecos
 * @property VeterinarioEndereco[] $veterinarioEnderecos
 */
class Estado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sgEstado', 'nmEstado'], 'required'],
            [['flAtivo', 'prioridade'], 'integer'],
            [['sgEstado'], 'string', 'max' => 2],
            [['nmEstado'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sgEstado' => 'Sigla',
            'nmEstado' => 'Nome',
            'flAtivo' => 'Ativo',
            'prioridade' => 'Prioridade',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCidades()
    {
        return $this->hasMany(Cidade::className(), ['idEstado' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClinicaEnderecos()
    {
        return $this->hasMany(ClinicaEndereco::className(), ['uf' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProprietarioEnderecos()
    {
        return $this->hasMany(ProprietarioEndereco::className(), ['uf' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVeterinarioEnderecos()
    {
        return $this->hasMany(VeterinarioEndereco::className(), ['uf' => 'id']);
    }

    /**
     * @inheritdoc
     * @return EstadoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EstadoQuery(get_called_class());
    }
}
