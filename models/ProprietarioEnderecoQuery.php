<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ProprietarioEndereco]].
 *
 * @see ProprietarioEndereco
 */
class ProprietarioEnderecoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ProprietarioEndereco[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ProprietarioEndereco|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
