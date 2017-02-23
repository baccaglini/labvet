<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ClinicaEndereco]].
 *
 * @see ClinicaEndereco
 */
class ClinicaEnderecoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ClinicaEndereco[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ClinicaEndereco|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
