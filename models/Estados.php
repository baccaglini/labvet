<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estados".
 *
 * @property integer $id
 * @property string $sgEstado
 * @property string $nmEstado
 * @property integer $flAtivo
 *
 * @property Cidades[] $cidades
 */
class Estados extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estados';
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
            [['sgEstado', 'nmEstado'], 'required'],
            [['flAtivo'], 'integer'],
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
            'sgEstado' => 'Sg Estado',
            'nmEstado' => 'Nm Estado',
            'flAtivo' => 'Fl Ativo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCidades()
    {
        return $this->hasMany(Cidades::className(), ['idEstado' => 'id']);
    }

    /**
     * @inheritdoc
     * @return EstadosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EstadosQuery(get_called_class());
    }
}
