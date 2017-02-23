<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "atendimento".
 *
 * @property integer $id
 * @property integer $proprietario
 * @property integer $sequencia
 * @property integer $veterinario
 * @property integer $clinica
 * @property integer $usuario
 * @property string $cadastro
 * @property integer $ativo
 *
 * @property Clinica $clinica0
 * @property ProprietarioAnimal $proprietario0
 * @property Administrador $usuario0
 * @property Veterinario $veterinario0
 * @property AtendimentoExame[] $atendimentoExames
 */
class Atendimento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'atendimento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['proprietario', 'sequencia', 'veterinario', 'usuario', 'cadastro'], 'required'],
            [['proprietario', 'sequencia', 'veterinario', 'clinica', 'usuario', 'ativo'], 'integer'],
            [['cadastro'], 'safe'],
            [['clinica'], 'exist', 'skipOnError' => true, 'targetClass' => Clinica::className(), 'targetAttribute' => ['clinica' => 'id']],
            [['proprietario', 'sequencia'], 'exist', 'skipOnError' => true, 'targetClass' => ProprietarioAnimal::className(), 'targetAttribute' => ['proprietario' => 'proprietario', 'sequencia' => 'sequencia']],
            [['usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Administrador::className(), 'targetAttribute' => ['usuario' => 'id']],
            [['veterinario'], 'exist', 'skipOnError' => true, 'targetClass' => Veterinario::className(), 'targetAttribute' => ['veterinario' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'proprietario' => 'Proprietario',
            'sequencia' => 'Sequencia',
            'veterinario' => 'Veterinario',
            'clinica' => 'Clinica',
            'usuario' => 'Usuario',
            'cadastro' => 'Cadastro',
            'ativo' => 'Ativo',
        ];
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
    public function getProprietario0()
    {
        //return $this->hasOne(ProprietarioAnimal::className(), ['proprietario' => 'proprietario', 'sequencia' => 'sequencia']);
        return $this->hasOne(Proprietario::className(), ['id' => 'proprietario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario0()
    {
        return $this->hasOne(Administrador::className(), ['id' => 'usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVeterinario0()
    {
        return $this->hasOne(Veterinario::className(), ['id' => 'veterinario']);
    }

    public function getAnimal0()
    {
        return $this->hasOne(ProprietarioAnimal::className(), ['proprietario' => 'proprietario', 'sequencia' => 'sequencia']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtendimentoExames()
    {
        return $this->hasMany(AtendimentoExame::className(), ['atendimento' => 'id']);
    }

    /**
     * @inheritdoc
     * @return AtendimentoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AtendimentoQuery(get_called_class());
    }
}
