<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "administrador".
 *
 * @property integer $id
 * @property string $username
 * @property string $nome
 * @property string $email
 * @property string $password
 * @property integer $ativo
 * @property integer $adm
 * @property string $token
 *
 * @property Acesso[] $acessos
 * @property Atendimento[] $atendimentos
 */
class Administrador extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'administrador';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'nome', 'email', 'password'], 'required'],
            [['ativo', 'adm'], 'integer'],
            [['username', 'token'], 'string', 'max' => 50],
            [['nome', 'password'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 150],
            [['username'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'nome' => 'Nome',
            'email' => 'Email',
            'password' => 'Password',
            'ativo' => 'Ativo',
            'adm' => 'Adm',
            'token' => 'Token',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcessos()
    {
        return $this->hasMany(Acesso::className(), ['usuario' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtendimentos()
    {
        return $this->hasMany(Atendimento::className(), ['usuario' => 'id']);
    }

    /** METODOS IMPLEMENTADOS DE IdentityInterface */
    public function getAuthKey() {
        throw new \yii\base\NotSupportedException();
    }

    public function getId() {
        return $this->id;
    }

    public function validateAuthKey($authKey) {
        throw new \yii\base\NotSupportedException();
    }

    public static function findIdentity($id) {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        throw new \yii\base\NotSupportedException();
    }
    
    /** IMPLEMANTAÇÕES PARA AUTENTICAÇÃO */
    public static function findByUsername($username){
        return self::findOne(['username' => $username]);
    }
    
    public function validatePassword($password){
        return $this->password === sha1($password);
    }
    
}
