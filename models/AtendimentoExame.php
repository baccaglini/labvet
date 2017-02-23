<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "atendimento_exame".
 *
 * @property integer $atendimento
 * @property integer $exame
 * @property integer $amostra
 * @property string $coleta
 * @property double $valor
 * @property string $liberacao
 * @property string $obs
 * @property integer $usuario
 * @property string $cadastro
 * @property integer $ativo
 *
 * @property Atendimento $atendimento0
 * @property ExameAmostra $exame0
 * @property Administrador $usuario0
 */
class AtendimentoExame extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'atendimento_exame';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['atendimento', 'exame', 'amostra', 'valor', 'usuario', 'cadastro'], 'required'],
            [['atendimento', 'exame', 'amostra', 'usuario', 'ativo'], 'integer'],
            [['valor'], 'number'],
            [['liberacao', 'cadastro'], 'safe'],
            [['obs'], 'string'],
            [['coleta'], 'string', 'max' => 2],
            [['atendimento'], 'exist', 'skipOnError' => true, 'targetClass' => Atendimento::className(), 'targetAttribute' => ['atendimento' => 'id']],
            [['exame', 'amostra'], 'exist', 'skipOnError' => true, 'targetClass' => ExameAmostra::className(), 'targetAttribute' => ['exame' => 'exame', 'amostra' => 'amostra']],
            [['usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Administrador::className(), 'targetAttribute' => ['usuario' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'atendimento' => 'Atendimento',
            'exame' => 'Exame',
            'amostra' => 'Amostra',
            'coleta' => 'Coleta',
            'valor' => 'Valor',
            'liberacao' => 'Liberacao',
            'obs' => 'Obs',
            'usuario' => 'Usuario',
            'cadastro' => 'Cadastro',
            'ativo' => 'Ativo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtendimento0()
    {
        return $this->hasOne(Atendimento::className(), ['id' => 'atendimento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExame0()
    {
        return $this->hasOne(ExameAmostra::className(), ['exame' => 'exame', 'amostra' => 'amostra']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario0()
    {
        return $this->hasOne(Administrador::className(), ['id' => 'usuario']);
    }

    /**
     * @inheritdoc
     * @return AtendimentoExameQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AtendimentoExameQuery(get_called_class());
    }
}
