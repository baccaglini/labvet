<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cidades".
 *
 * @property integer $id
 * @property integer $idEstado
 * @property string $nmCidades
 * @property integer $flAtivo
 *
 * @property Estados $idEstado0
 */
class Cidades extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cidades';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_comum');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idEstado', 'nmCidades'], 'required'],
            [['idEstado', 'flAtivo'], 'integer'],
            [['nmCidades'], 'string', 'max' => 255],
            [['idEstado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['idEstado' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idEstado' => 'Id Estado',
            'nmCidades' => 'Nm Cidades',
            'flAtivo' => 'Fl Ativo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEstado0()
    {
        return $this->hasOne(Estados::className(), ['id' => 'idEstado']);
    }

    /**
     * @inheritdoc
     * @return CidadesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CidadesQuery(get_called_class());
    }
}
